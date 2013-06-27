import urllib
import jinja2
import os

from google.appengine.api import users
from forms import *
from Users import *

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

# outer level of query, for deciding which type of form to query
def form_query_all(query_params):
    try:
        if query_params['form_type'] == 'signup':
            query = form_query(SignupForm, query_params)
        elif query_params['form_type'] == 'february':
            query = form_query(FebruaryForm, query_params)
        elif query_params['form_type'] == 'checkpoint':
            query = form_query(CheckpointForm, query_params)
        else: # form_type == 'second_reader':
            query = form_query(SecondReaderForm, query_params)
        return query
    except KeyError:
        print 'form_type is not in query_params'

def build_query_params(self):
    args = ['form_type', 'student_name', 'student_netID', 'advisor_name', 'advisor_netID', 'user_type', 'netID']
    query_params = {}
    for arg in args:
        arg_get = self.request.get(arg)
        if arg_get != '':
            query_params[arg] = arg_get
    return query_params


# returns all users of all user_types
def user_query_all(query_params):
    try:
        if query_params['user_type'] == 'student':
            query = object_query(Student, query_params)
        elif query_params['user_type'] == 'faculty':
            query = object_query(Faculty, query_params)
        else: # query_params['user_type'] == 'administrator':
            query = object_query(Administrator, query_params)
        return query
    except KeyError:
        print 'form_type is not in query_params'

# # overloaded method to obtain all users - replace when we think of a better way
# nevermind - no overloading in python
# def user_query_all():
#     students       = Student.query().fetch()
#     faculty        = Faculty.query().fetch()
#     administrators = Administrator.query().fetch()
#     users = []
#     for student in students:
#         users.append(student)
#     for prof in faculty:
#         users.append(prof)
#     for admin in administrators:
#         users.append(admin)
#     return users

# check if a student has submitted a given form yet
# in the case of submitted forms, query_params only contains form_type and student_netID
def validateFormSubmission(self, form):
    query_params = {'student_netID':form.student_netID,'form_type':form.form_type}
    query = form_query_all(query_params)
    forms = query.fetch(1)
    if len(forms) == 0:
        alreadySubmitted = False
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
    query = user_query_all(query_params)
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
