import urllib
import jinja2
import os

from google.appengine.api import users
from forms import *
from Users import *
from messages import *

from gaesessions import get_current_session

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

# Queries a form or user based on given query parameters
def object_query(object_class, query_params):

    query = object_class.query()
    for kw, vals in query_params.items():
        if not isinstance(vals, (list, tuple)):
            vals = (vals,)
        for v in vals:
            query = query.filter(getattr(object_class, kw) ==v) #ndb.GenericProperty(kw) == v)
    return query

def build_query_params(self):
    args = ['form_type', 'student_name', 'student_netID', 'advisor_name', 'advisor_netID', 'user_type', 'netID']
    query_params = {}
    for arg in args:
        arg_get = self.request.get(arg)
        if arg_get != '':
            query_params[arg] = arg_get
    return query_params

# check if a student has submitted a given form yet
# in the case of submitted forms, query_params only contains form_type and student_netID
def validateFormSubmission(self, form):
    query_params = {'student_netID':form.student_netID,'form_type':form.form_type}
    query = object_query(Form, query_params)
    forms = query.fetch(1)
    if not form.submitted:
        alreadySubmitted = False
        form.submitted = True
    else:
        alreadySubmitted = True

    # update relevant datastore properties
    if not alreadySubmitted:
        # first, add form to database
        form.put()

        # # update student's submitted forms list
        # student.forms_submitted.append(form.form_type) # when we get users working
        # # for signup form, update student's advisor_netID:
        # if form.form_type == "signup":
        #     student.advisor_netID = form.advisor_netID

        # set the next url using student_netID and form_type
        self.redirect('/forms/view?' + urllib.urlencode(query_params))
    else:
        self.redirect('/forms/invalid_entry?' + urllib.urlencode(query_params))

def validateNewUser(self, user):
    query_params = {'netID':user.netID,'user_type':user.user_type}
    query = object_query(User, query_params)
    users = query.fetch(1)
    if len(users) == 0:
        alreadySubmitted = False
    else:
        alreadySubmitted = True
    # add user/ information to the database
    if not alreadySubmitted:
        user.put()
        # sets the next url using student_netID and form_type
        self.redirect('/administrative/users?' + urllib.urlencode(query_params))
    else:
        self.redirect('/administrative/invalid_entry?' + urllib.urlencode(query_params))

def getCurrentUser(self):
    session = get_current_session()

    if (session.has_key('user')):
        user = session['user']
        return user

    if session.has_key('user'):
        return session['user']

    else:
        return None

def getMessages(self):
    query_params = build_query_params(self)
    query = object_query(Message, query_params).order(Message.date)
    return query.fetch()
