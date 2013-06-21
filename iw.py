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

def getLoginStatus(uri):
    if users.get_current_user():
        url = users.create_logout_url(uri)
        url_linktext = 'Logout'
    else:
        url = users.create_login_url(uri)
        url_linktext = 'Login'
    return (url, url_linktext)

class SignupForm(ndb.Model):
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
    form_type = ndb.StringProperty(default="checkpoint")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    topic_title = ndb.StringProperty()
    advisor = ndb.StringProperty()
    meetings_w_advisor = ndb.IntegerProperty()
    self_assessment = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_read_summary = ndb.BooleanProperty()
    meet_more_often = ndb.BooleanProperty()
    student_progress = ndb.IntegerProperty(choices=set([4, 3, 2, 1]))
    comments = ndb.StringProperty()

class FebruaryForm(ndb.Model):
    form_type = ndb.StringProperty(default="february")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    number_of_meetings = ndb.IntegerProperty()
    student_comments = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_signature = ndb.BooleanProperty()
    advisor_read = ndb.BooleanProperty()
    advisor_more_meetings = ndb.BooleanProperty()
    student_progress_eval = ndb.IntegerProperty(choices=set([1,2,3]))
    advisor_comments = ndb.StringProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)

class SecondReaderForm(ndb.Model):
    form_type = ndb.StringProperty(default="second_reader")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    class_year = ndb.IntegerProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    sr_name = ndb.StringProperty()
    sr_netID = ndb.StringProperty()
    sr_department = ndb.StringProperty()
    sr_agreement = ndb.BooleanProperty()
    sr_signature = ndb.StringProperty()

class MainPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('index.html')
        self.response.write(template.render(template_values))

class SignupFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }        
        template = JINJA_ENVIRONMENT.get_template('signupform.html')
        self.response.write(template.render(template_values))

    def post(self):

        sf = SignupForm(student_name=self.request.get('student_name'),
                        class_year = int(self.request.get('class_year')),
                        coursework = self.request.get('coursework'),
                        title = self.request.get('titles'),
                        description = self.request.get('description'),
                        advisor_signature = bool(self.request.get('advisor_signature')),
                        advisor_name = self.request.get('advisor_name'),
                        advisor_department = self.request.get('advisor_department'),
                        student_signature = bool(self.request.get('student_signature')),
                        student_netID = "test"
                        )

        sf.put()

        query_params = {'student_netID':sf.student_netID,'form_type':sf.form_type}
        # self.redirect('/forms/signupform/view?' + urllib.urlencode(query_params))
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class CheckPointFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('checkpointform.html')
        self.response.write(template.render(template_values))

    def post(self):

        cpf = CheckpointForm(student_name=self.request.get('student_name'),
                             topic_title = self.request.get('topic_title'),
                             advisor = self.request.get('advisor'),
                             meetings_w_advisor = int(self.request.get('meetings_w_advisor')),
                             self_assessment = self.request.get('self_assessment'),
                             advisor_read_summary = bool(self.request.get('advisor_read_summary')),
                             meet_more_often = bool(self.request.get('meet_more_often')),
                             student_progress = int(self.request.get('student_progress')),
                             comments = self.request.get('comments'),
                             student_netID = "test"
                             )
        cpf.put()

        query_params = {'student_netID':cpf.student_netID, 'form_type':cpf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class SecondReaderFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('second_reader_form.html')
        self.response.write(template.render(template_values))


    def post(self):
        srf = SecondReaderForm(student_name=self.request.get('student_name'), 
                               class_year =int(self.request.get('class_year')),
                               title = self.request.get('title'),
                               description = self.request.get('description'),
                               sr_name = self.request.get('sr_name'),
                               sr_netID = self.request.get('sr_netID'),
                               sr_department = self.request.get('sr_department'),
                               sr_agreement =bool(self.request.get('sr_agreement')),
                               sr_signature = self.request.get('sr_signature'),
                               student_netID = "test"
                               )

        srf.put()

        query_params = {'student_netID':srf.student_netID, 'form_type':srf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))


class FebruaryFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('february_form.html')
        self.response.write(template.render(template_values))

    def post(self):
        
        ff = FebruaryForm(student_name = self.request.get('student_name'),
                          title = self.request.get('title'),
                          description = self.request.get('description'),
                          advisor_name = self.request.get('advisor_name'),
                          number_of_meetings = int(self.request.get('number_of_meetings')),
                          student_comments = self.request.get('student_comments'),
                          advisor_read = bool(self.request.get('advisor_read')),
                          advisor_more_meetings = bool(self.request.get('advisor_more_meetings')),
                          student_progress_eval = int(self.request.get('student_progress_eval')),
                          advisor_comments = self.request.get('advisor_comments'),
                          student_netID = "test"
                      )
        ff.put()

        query_params = {'student_netID':ff.student_netID, 'form_type':ff.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))


class FormView(webapp2.RequestHandler):
    
    def get(self):
        form_type = self.request.get('form_type')
        student_netID = self.request.get('student_netID')        
        if form_type == 'signup':
            query = SignupForm.query(SignupForm.student_netID==student_netID)
            form = query.fetch(1)[0] # this might be buggy
        elif form_type == 'february':
            query = FebruaryForm.query(FebruaryForm.student_netID==student_netID)
            form = query.fetch(1)[0]
        elif form_type == 'checkpoint':
            query = CheckpointForm.query(CheckpointForm.student_netID==student_netID)
            form = query.fetch(1)[0]
        else:# form_type == 'second_reader':
            query = SecondReaderForm.query(SecondReaderForm.student_netID==student_netID)
            form = query.fetch(1)[0]

        template_values = {
            'form': form,
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % form_type)
        self.response.write(template.render(template_values))

class FormQuery(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('query.html')
        self.response.write(template.render(template_values))

    def post(self):
        # form_type is required, so get it separately:
        form_type = self.request.get('form_type')
        # additional arguments:
        args = ['student_name', 'student_netID', 'advisor_name', 'advisor_netID']
        query_params = {}
        for arg in args:
            arg_get = self.request.get(arg)
            if arg_get != 'Null':
                query_params[arg] = arg_get

        # Is there a better way of doing this?
        if form_type == 'signup':
            query = SignupForm.query()
            if 'student_name' in query_params:
                query.filter(SignupForm.student_name==query_params['student_name'])
            if 'student_netID' in query_params:
                query.filter(SignupForm.student_netID==query_params['student_netID'])
            if 'advisor_name' in query_params:
                query.filter(SignupForm.advisor_name==query_params['advisor_name'])
            if 'advisor_netID' in query_params:
                query.filter(SignupForm.advisor_netID==query_params['advisor_netID'])
            forms = query.fetch(20) # this might be buggy
        elif form_type == 'february':
            query = FebruaryForm.query()
            if 'student_name' in query_params:
                query.filter(FebruaryForm.student_name==query_params['student_name'])
            if 'student_netID' in query_params:
                query.filter(FebruaryForm.student_netID==query_params['student_netID'])
            if 'advisor_name' in query_params:
                query.filter(FebruaryForm.advisor_name==query_params['advisor_name'])
            if 'advisor_netID' in query_params:
                query.filter(FebruaryForm.advisor_netID==query_params['advisor_netID'])
            forms = query.fetch(20)
        elif form_type == 'checkpoint':
            query = CheckpointForm.query()
            if 'student_name' in query_params:
                query.filter(CheckpointForm.student_name==query_params['student_name'])
            if 'student_netID' in query_params:
                query.filter(CheckpointForm.student_netID==query_params['student_netID'])
            if 'advisor_name' in query_params:
                query.filter(CheckpointForm.advisor_name==query_params['advisor_name'])
            if 'advisor_netID' in query_params:
                query.filter(CheckpointForm.advisor_netID==query_params['advisor_netID'])
            forms = query.fetch(20)
        elif form_type == 'second_reader': # form_type == 'second_reader':
            query = SecondReaderForm.query()
            if 'student_name' in query_params:
                query.filter(SecondReaderForm.student_name==query_params['student_name'])
            if 'student_netID' in query_params:
                query.filter(SecondReaderForm.student_netID==query_params['student_netID'])
            if 'advisor_name' in query_params:
                query.filter(SecondReaderForm.advisor_name==query_params['advisor_name'])
            if 'advisor_netID' in query_params:
                query.filter(SecondReaderForm.advisor_netID==query_params['advisor_netID'])
            forms = query.fetch(20)

        query_params = {'forms': forms}
        self.redirect('/forms/view_query?' + urllib.urlencode(query_params))

class ViewQuery(webapp2.RequestHandler):

    def get(self):
        forms = self.request.get('forms')
        template_values = {
            'forms':forms,
            'url': getLoginStatus(self.request.uri)[0], #url,
            'url_linktext': getLoginStatus(self.request.uri)[1], #url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('view_query.html')
        self.response.write(template.render(template_values))


application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/forms/signupform', SignupFormPage),
    ('/forms/secondreaderform', SecondReaderFormPage),
    ('/forms/checkpointform', CheckPointFormPage),
    ('/forms/februaryform', FebruaryFormPage),
    ('/forms/view', FormView),
    ('/forms/query', FormQuery),
    ('/forms/view_query', ViewQuery),
], debug=True)
