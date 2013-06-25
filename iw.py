import os
import urllib
import datetime

from google.appengine.api import users
from google.appengine.ext import ndb
from google.appengine.ext import gql

import jinja2
import webapp2

JINJA_ENVIRONMENT = jinja2.Environment(
    loader=jinja2.FileSystemLoader(os.path.dirname(__file__)),
    extensions=['jinja2.ext.autoescape'])

# for encoding dictionary urls in jinja
# note: Jinja 2.7 includes a urlencode filter by default, but GAE uses Jinja 2.6
#       This hack seems to work for our small purposes, but it may not be as
#       robust as the Jinja library filters.
def do_urlencode(dict):
    url = urllib.urlencode(dict)
    return url

# update jinja filter:
JINJA_ENVIRONMENT.filters['urlencode'] = do_urlencode

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

class SignupForm(ndb.Model):
    # needs form_type, student_name, student_netID, advisor_name, advisor_netID
    form_type = ndb.StringProperty(default="signup")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    class_year = ndb.IntegerProperty()
    coursework = ndb.StringProperty(choices=set(["397", "398", "497", "498", "AB JIW", "AB Senior Thesis", "BSE Senior Thesis"]))
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_signature = ndb.BooleanProperty()
    advisor_name = ndb.StringProperty()
    advisor_department = ndb.StringProperty()
    student_signature = ndb.BooleanProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)
    # consider adding properties = ndb.PickleProperty() which is a list of the properties of each form

class CheckpointForm(ndb.Model):
    # needs form_type, student_name, student_netID, advisor_name, advisor_netID
    form_type = ndb.StringProperty(default="checkpoint")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    topic_title = ndb.StringProperty()
    advisor = ndb.StringProperty()
    meetings_w_advisor = ndb.IntegerProperty()
    self_assessment = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_read_summary = ndb.BooleanProperty()
    meet_more_often = ndb.BooleanProperty()
    student_progress = ndb.IntegerProperty(choices=set([4, 3, 2, 1]))
    comments = ndb.StringProperty()

class FebruaryForm(ndb.Model):
    # needs form_type, student_name, student_netID, advisor_name, advisor_netID
    form_type = ndb.StringProperty(default="february")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    number_of_meetings = ndb.IntegerProperty()
    student_comments = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_signature = ndb.BooleanProperty()
    advisor_read = ndb.BooleanProperty()
    advisor_more_meetings = ndb.BooleanProperty()
    student_progress_eval = ndb.IntegerProperty(choices=set([1,2,3]))
    advisor_comments = ndb.StringProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)

class SecondReaderForm(ndb.Model):
    # needs form_type, student_name, student_netID, advisor_name, advisor_netID
    form_type = ndb.StringProperty(default="second_reader")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    class_year = ndb.IntegerProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    sr_name = ndb.StringProperty()
    sr_netID = ndb.StringProperty()
    sr_department = ndb.StringProperty()
    sr_agreement = ndb.BooleanProperty()
    sr_signature = ndb.StringProperty()

class MainPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], 
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('index.html')
        self.response.write(template.render(template_values))

class SignupFormPage(webapp2.RequestHandler):
    # get information from the user
    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], 
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }        
        template = JINJA_ENVIRONMENT.get_template('signupform.html')
        self.response.write(template.render(template_values))

    def post(self):
        ##### FIX THE ADVISOR NET ID --->>> RIGHT NOW IT IS HARDWIRED
        # get the information entered by user
        sf = SignupForm(student_name=self.request.get('student_name'),
                        class_year = int(self.request.get('class_year')),
                        coursework = self.request.get('coursework'),
                        title = self.request.get('title'),
                        description = self.request.get('description'),
                        advisor_signature = bool(self.request.get('advisor_signature')),
                        advisor_name = self.request.get('advisor_name'),
                        advisor_netID = 'olivia',
                        advisor_department = self.request.get('advisor_department'),
                        student_signature = bool(self.request.get('student_signature')),
                        student_netID = self.request.get('student_netID')
                        )
        # add user/ information to the database
        sf.put()
        # sets the next url using student_netID and form_type
        query_params = {'student_netID':sf.student_netID,'form_type':sf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class CheckPointFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('checkpointform.html')
        self.response.write(template.render(template_values))

    def post(self):
        ##### FIX ADVISOR NET ID (HARDWIRED), ALSO CHANGE ADVISOR IN CHECKPOINT FORMS TO ADVISOR_NAME
        cpf = CheckpointForm(student_name=self.request.get('student_name'),
                             topic_title = self.request.get('topic_title'),
                             advisor_name = self.request.get('advisor'),
                             advisor_netID = 'olivia',
                             meetings_w_advisor = int(self.request.get('meetings_w_advisor')),
                             self_assessment = self.request.get('self_assessment'),
                             advisor_read_summary = bool(self.request.get('advisor_read_summary')),
                             meet_more_often = bool(self.request.get('meet_more_often')),
                             student_progress = int(self.request.get('student_progress')),
                             comments = self.request.get('comments'),
                             student_netID = self.request.get('student_netID')
                             )
        cpf.put()

        query_params = {'student_netID':cpf.student_netID, 'form_type':cpf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class SecondReaderFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], 
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('second_reader_form.html')
        self.response.write(template.render(template_values))


    def post(self):
        ###### FIX ADVISOR NAME AND ADVISOR NETID (HARDWIRED) & ALL FORMS RELATED TO SR
        srf = SecondReaderForm(student_name=self.request.get('student_name'), 
                               class_year =int(self.request.get('class_year')),
                               title = self.request.get('title'),
                               description = self.request.get('description'),
                               advisor_name = "olivia",
                               advisor_netID = "olivia",
                               sr_name = self.request.get('sr_name'),
                               sr_netID = self.request.get('sr_netID'),
                               sr_department = self.request.get('sr_department'),
                               sr_agreement =bool(self.request.get('sr_agreement')),
                               sr_signature = self.request.get('sr_signature'),
                               student_netID = self.request.get('student_netID')
                               )

        srf.put()

        query_params = {'student_netID':srf.student_netID, 'form_type':srf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))


class FebruaryFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('february_form.html')
        self.response.write(template.render(template_values))

    def post(self):
        ###### FIX ADVISOR_NETID (HARDWIRED)
        ff = FebruaryForm(student_name = self.request.get('student_name'),
                          title = self.request.get('title'),
                          description = self.request.get('description'),
                          advisor_name = self.request.get('advisor_name'),
                          advisor_netID = "olivia",
                          number_of_meetings = int(self.request.get('number_of_meetings')),
                          student_comments = self.request.get('student_comments'),
                          advisor_read = bool(self.request.get('advisor_read')),
                          advisor_more_meetings = bool(self.request.get('advisor_more_meetings')),
                          student_progress_eval = int(self.request.get('student_progress_eval')),
                          advisor_comments = self.request.get('advisor_comments'),
                          student_netID = self.request.get('student_netID')
                      )
        ff.put()

        query_params = {'student_netID':ff.student_netID, 'form_type':ff.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))


class FormView(webapp2.RequestHandler):
    # this shows the results of what has been submitted
    def get(self):
        # calls helper method
        query_params = build_query_params(self)
        query = make_query_all(query_params)
        forms = query.fetch(1)
        form = forms[0]
        
        template_values = {
            'form': form,
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % form.form_type)
        self.response.write(template.render(template_values))

class FormQuery(webapp2.RequestHandler):
    # user inputs what he/she wants to query
    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('query.html')
        self.response.write(template.render(template_values))
    
    def post(self):
        # calls helper method
        query_params = build_query_params(self)
        self.redirect('/forms/query_results?' + urllib.urlencode(query_params))

class QueryResults(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        if 'form_type' in query_params:
            query = make_query_all(query_params)
            forms = query.fetch(20)
        else: # form_type has not been entered as a query criterion
            forms = []
            for form_type in [SignupForm, FebruaryForm, CheckpointForm, SecondReaderForm]:
                for form in make_query(form_type, query_params).fetch(20):
                    forms.append(form)
        
        template_values = {
            'forms':forms,
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('query_results.html')
        self.response.write(template.render(template_values))

class QueryView(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query = make_query_all(query_params)

        form = query.fetch(1)

        template_values = {
            'form':form[0], # pass form as form object rather than list
            'url': getLoginStatus(self.request.uri)[0],
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % query_params['form_type'])
        self.response.write(template.render(template_values))

class FormDelete(webapp2.RequestHandler):
    
    def get(self):
        query_params = build_query_params(self)
        if 'form_type' in query_params:
            query  = make_query_all(query_params)
            form = query.fetch(1)[0]
            form.key.delete()

        self.redirect('/forms/query_results?' + urllib.urlencode(query_params))


class Upload(webapp2.RequestHandler):
    def get(self):
        template_values = {}
        template = JINJA_ENVIRONMENT.get_template('upload.html')
        self.response.write(template.render(template_values))


        
        

application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/forms/signupform', SignupFormPage),
    ('/forms/secondreaderform', SecondReaderFormPage),
    ('/forms/checkpointform', CheckPointFormPage),
    ('/forms/februaryform', FebruaryFormPage),
    ('/forms/view', FormView),
    ('/forms/query', FormQuery),
    ('/forms/query_results', QueryResults),
    ('/forms/query_view', QueryView),
    ('/forms/form_delete', FormDelete),
    ('/files/upload', Upload),

], debug=True)
