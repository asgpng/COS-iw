import urllib
import jinja2
import os
import time

from google.appengine.api import users
from models import *

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
    args = ['form_type', 'student_name', 'student_netID', 'advisor_name', 'advisor_netID', 'user_type', 'netID', 'failed']
    query_params = {}
    for arg in args:
        arg_get = self.request.get(arg)
        if arg_get != '':
            query_params[arg] = arg_get
    return query_params


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
        time.sleep(0.1)
        # sets the next url using student_netID and form_type
        self.redirect('/admin/users?' + urllib.urlencode(query_params))
    else:
        self.redirect('/admin/invalid_entry?' + urllib.urlencode(query_params))

def getCurrentUser(self):
    session = get_current_session()

    if session.has_key('user'):
        return session['user']

    else:
        return None


def getMessages(self):
    user = getCurrentUser(self)
    # show all messages for administrator
    if user.user_type == 'administrator':
        query_params = {}
    else:
        query_params = {'author_netID':user.netID}

    query = object_query(Message, query_params).order(Message.date)
    messages = query.fetch()

    # perform second query to link student and advisors
    # needs work, in particular -> sorting
    if user.user_type == 'student' and user.advisor_netID != None:
        query2 = object_query(Message, {'author_netID':user.advisor_netID})
        messages.append(query2.fetch())
    if user.user_type == 'faculty' and len(user.student_netIDs) != 0:
        query_params = {'author_netID':user.student_netIDs[0]}
        query2 = object_query(Message, query_params)
        messages.append(query2.fetch())

    return messages



def validateNetID(advisor_netID):
     query_params = {'netID': advisor_netID}
     query = object_query(Faculty, query_params)
     user_faculty = query.get()
     return (user_faculty != None)
