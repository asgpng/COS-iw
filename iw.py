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

class SignupForm(ndb.Model):
    form_type = ndb.StringProperty()
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

class CheckpointForm(ndb.Model):
    form_type = ndb.StringProperty("checkpoint")
    student_netID = ndb.StringProperty("test")
    student_name = ndb.StringProperty()
    topic_title = ndb.StringProperty()
    advisor = ndb.StringProperty()
    meetings_w_advisor = ndb.IntegerProperty()
    self_assessment = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_read_summary = ndb.StringProperty(choices=set(["yes", "no"]))
    meet_more_often = ndb.StringProperty(choices=set(["yes", "no"]))
    student_progress = ndb.StringProperty(choices=set(["4", "3", "2", "1"]))
    comments = ndb.StringProperty()

class FebruaryForm(ndb.Model):
    form_type = ndb.StringProperty("february")
    student_netID = ndb.StringProperty()
    student_name = ndb.StringProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_name = ndb.StringProperty()
    number_of_meetings = ndb.IntegerProperty()
    student_comments = ndb.StringProperty()
    faculty_netID = ndb.StringProperty()
    faculty_signature = ndb.BooleanProperty()
    faculty_read = ndb.BooleanProperty()
    faculty_more_meetings = ndb.BooleanProperty()
    student_progress_eval = ndb.IntegerProperty(choices=set([1,2,3]))
    faculty_comments = ndb.StringProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)


class MainPage(webapp2.RequestHandler):

    def get(self):
        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'url': url,
            'url_linktext': url_linktext,
        }

        template = JINJA_ENVIRONMENT.get_template('index.html')
        self.response.write(template.render(template_values))

class SignupFormPage(webapp2.RequestHandler):

    def get(self):
        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'url': url,
            'url_linktext': url_linktext,
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
                        form_type = "signup",
                        student_netID = "test"
                        )

        sf.put()

        query_params = {'student_netID':sf.student_netID,'form_type':sf.form_type}
        # self.redirect('/forms/signupform/view?' + urllib.urlencode(query_params))
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class CheckPointFormPage(webapp2.RequestHandler):

    def get(self):
        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('checkpointform.html')
        self.response.write(template.render(template_values))

    def post(self):

        cpf = CheckpointForm(student_name=self.request.get('student_name'),
                             topic_title = self.request.get('topic_title'),
                             advisor = self.request.get('advisor'),
                             meetings_w_advisor = self.request.get('meetings_w_advisor'),
                             self_assessment = self.request.get('self_assessment'),
                             advisor_read_summary = self.request.get('advisor_read_summary'),
                             meet_more_often = self.request.get('meet_more_often'),
                             student_progress = int(self.request.get('student_progress')),
                             comments = self.request.get('comments_1')
                             )
        cpf.put()

        query_params = {'student_netID':cpf.student_netID, 'form_type':cpf.form_type}
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class SecondReaderFormPage(webapp2.RequestHandler):

    def get(self):

        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('second_reader_form.html')
        self.response.write(template.render(template_values))

class FebruaryFormPage(webapp2.RequestHandler):

    def get(self):
        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('february_form.html')
        self.response.write(template.render(template_values))

    def post(self):
        
        ff = FebruaryForm(student_name = self.request.get('student_name'),
                          title = self.request.get('title'),
                          description = self.request.get('description'),
                          advisor_signature = self.request.get('advisor_signature'),
                          advisor_name = self.request.get('advisor_name'),
                          number_of_meetings = self.request.get('number_of_meetings'),
                          student_comments = self.request.get('student_comments'),
                          advisor_read = self.request.get('advisor_read'),
                          advisor_more_meetings = self.request.get('advisor_more_meetings'),
                          student_progress_eval = self.request.get('student_progress_eval'),
                          advisor_comments = self.request.get('advisor_comments'),
                      )
        ff.put()

        query_params = {'student_name':sf.student_name}
        self.redirect('/forms/signupform/view?' + urllib.urlencode(query_params))

class FormView(webapp2.RequestHandler):
    
    def get(self):
        form_type = self.request.get('form_type')
        student_netID = self.request.get('student_netID')        
        if form_type == 'signup':
            query = SignupForm.query(SignupForm.student_netID==student_netID)
            form = query.fetch(1)[0]
        elif form_type == 'february':
            query = FebruaryForm.query(SignupForm.student_netID==student_netID)
            form = query.fetch(1)[0]
        # update these:
        elif form_type == 'checkpoint':
            query = SignupForm.query(SignupForm.student_netID==student_netID)
            form = query.fetch(1)[0]
        else: # form_type == 'second_reader':
            query = FebruaryForm.query(SignupForm.student_netID==student_netID)
            form = query.fetch(1)

        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'form': form,
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % form_type)
        self.response.write(template.render(template_values))



application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/forms/signupform', SignupFormPage),
    ('/forms/secondreaderform', SecondReaderFormPage),
    ('/forms/checkpointform', CheckPointFormPage),
    ('/forms/februaryform', FebruaryFormPage),
    ('/forms/view', FormView),
], debug=True)
