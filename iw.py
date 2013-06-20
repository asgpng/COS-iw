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
    student_name = ndb.StringProperty()
    class_year = ndb.IntegerProperty()
    coursework = ndb.StringProperty(choices=set(["397", "398", "497", "498", "AB JIW", "AB Senior Thesis", "BSE Senior Thesis"]))
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    faculty_signature = ndb.BooleanProperty()
    faculty_name = ndb.StringProperty()
    faculty_department = ndb.StringProperty()
    student_signature = ndb.BooleanProperty()
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
                        faculty_signature = bool(self.request.get('faculty_signature')),
                        faculty_name = self.request.get('faculty_name'),
                        faculty_department = self.request.get('faculty_department'),
                        student_signature = bool(self.request.get('student_signature')))

        sf.put()

        query_params = {'student_name':sf.student_name}
        self.redirect('/forms/signupform/view?' + urllib.urlencode(query_params))

class SignupFormPageView(webapp2.RequestHandler):
        
    def get(self):

        # query = SignupForm.gql("where student_name = 'test' ")
        # sf = query.fetch(1)
        query = SignupForm.query(SignupForm.class_year==1999)
#        q.filter('student_name =', 'test')
        sf = query.fetch(1)
#        self.response.write(sf[0].class_year)

        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'


        template_values = {
            'sf': sf,
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('signup_form_view.html')
        self.response.write(template.render(template_values))


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


    

application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/forms/signupform', SignupFormPage),
    ('/forms/signupform/view', SignupFormPageView),
    ('/forms/secondreaderform', SecondReaderFormPage)
], debug=True)
