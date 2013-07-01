from google.appengine.api import users
import jinja2
import os



# for encoding dictionary urls in jinja
# note: Jinja 2.7 includes a urlencode filter by default, but GAE uses Jinja 2.6
#       This hack seems to work for our small purposes, but it may not be as
#       robust as the Jinja library filters.

def do_urlencode(dict):
    url = urllib.urlencode(dict)
    return url


def getLoginStatus(uri):
    if users.get_current_user():
        url = users.create_logout_url(uri)
        url_linktext = 'Logout'
    else:
        url = users.create_login_url(uri)
        url_linktext = 'Login'
    return (url, url_linktext)

# Queries a form_class based on given query parameters
def make_query(form_class, query_params):

    query = form_class.query()
    for kw, vals in query_params.items():
        if not isinstance(vals, (list, tuple)):
            vals = (vals,)
        for v in vals:
            query = query.filter(getattr(form_class, kw) ==v) #ndb.GenericProperty(kw) == v)
    return query

# outer level of query, for deciding which type of form to query
def make_query_all(query_params):
    try:
        if query_params['form_type'] == 'signup':
            query = make_query(SignupForm, query_params)
        elif query_params['form_type'] == 'february':
            query = make_query(FebruaryForm, query_params)
        elif query_params['form_type'] == 'checkpoint':
            query = make_query(CheckpointForm, query_params)
        else: # form_type == 'second_reader':
            query = make_query(SecondReaderForm, query_params)
        return query
    except KeyError:
        print 'form_type is not in query_params'

def build_query_params(self):
    args = ['form_type', 'student_name', 'student_netID', 'advisor_name', 'advisor_netID']
    query_params = {}
    for arg in args:
        arg_get = self.request.get(arg)
        if arg_get != '':
            query_params[arg] = arg_get
    return query_params

# check if a student has submitted a given form yet
# in the case of submitted forms, query_params only contains form_type and student_netID
def validateSubmission(self, form):
    query_params = {'student_netID':form.student_netID,'form_type':form.form_type}
    query = make_query_all(query_params)
    forms = query.fetch(1)
    if len(forms) == 0:
        alreadySubmitted = False
    else:
        alreadySubmitted = True
    # add user/ information to the database
    if not alreadySubmitted:
        form.put()
        # sets the next url using student_netID and form_type
        self.redirect('/forms/view?' + urllib.urlencode(query_params))
    else:
        self.redirect('/forms/invalid_entry?' + urllib.urlencode(query_params))
