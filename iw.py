# general python libraries
import os
import urllib
import datetime
import time

# web development libraries
import jinja2
import webapp2
import urllib

# GAE libraries
from google.appengine.api import files
from google.appengine.api import users
from google.appengine.ext import ndb
from google.appengine.ext import gql

from google.appengine.ext import blobstore
from google.appengine.ext.webapp import blobstore_handlers
from google.appengine.ext.blobstore import BlobInfo

from gaesessions import get_current_session

# custom libraries
from app.models import *
from app.helper_methods import *
from app.appengine_config import *

JINJA_ENVIRONMENT = jinja2.Environment(
    loader=jinja2.FileSystemLoader(os.path.dirname(__file__)),
    extensions=['jinja2.ext.autoescape'])

# update jinja filter:
JINJA_ENVIRONMENT.filters['urlencode'] = do_urlencode

class LoginPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self)
        }
        template = JINJA_ENVIRONMENT.get_template('login.html')
        self.response.write(template.render(template_values))

    def post(self):
        # eventually don't allow multiple login.
        session = get_current_session()

        query_params = build_query_params(self)
        query = object_query(User, query_params)
        users = query.fetch()
        # blank submissions are unauthorized
        if len(query_params) == 0:
            self.redirect('login/unauthorized?'+urllib.urlencode(query_params))
        elif len(users) == 0:
            self.redirect('login/unauthorized?'+urllib.urlencode(query_params))
        else:
            # user = User(netID="admin", user_type="administrator")
            user = query.fetch()[0]

            session['user'] = user
            # self.response.write(session)
            self.redirect('/')

class LoginUnauthorizedPage(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        if 'netID' in query_params:
            template_values = {
                'netID':query_params['netID']
            }
        else:
            template_values = {}
        template = JINJA_ENVIRONMENT.get_template('login_unauthorized.html')
        self.response.write(template.render(template_values))

class LogoutPage(webapp2.RequestHandler):

    def post(self):


        query_params = build_query_params(self)
        template_values = {
            'netID':query_params['netID'],
            'current_user': getCurrentUser(self)
        }

    def get(self):
        session = get_current_session()
        user = getCurrentUser(self)
        if user == None:
            self.redirect('login')
        else:
            session.terminate()
            self.redirect('/')

class MainPage(webapp2.RequestHandler):

    def get(self):
        user = getCurrentUser(self)
        if user == None:
            self.redirect('/login')
        else:
            template_values = {
                'current_user': getCurrentUser(self),
                'url_linktext': getLoginStatus(self.request.uri)[1],
            }
            template = JINJA_ENVIRONMENT.get_template('index.html')
            self.response.write(template.render(template_values))

class SignupFormPage(webapp2.RequestHandler):
    # get information from the user
    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('signupform.html')
        self.response.write(template.render(template_values))

    def post(self):
        # get the information entered by user
        sf = SignupForm(student_name=self.request.get('student_name'),
                        form_type= 'signup',
                        class_year = int(self.request.get('class_year')),
                        coursework = self.request.get('coursework'),
                        title = self.request.get('title'),
                        description = self.request.get('description'),
                        advisor_signature = bool(self.request.get('advisor_signature')),
                        advisor_name = self.request.get('advisor_name'),
                        advisor_netID = self.request.get('advisor_netID'),
                        advisor_department = self.request.get('advisor_department'),
                        student_signature = bool(self.request.get('student_signature')),
                        student_netID = self.request.get('student_netID')
                        )

        sf.put()

        current_user = getCurrentUser(self)
        current_user.advisor_netID = sf.advisor_netID
        query_params = {'netID': sf.advisor_netID}
        query = object_query(Faculty, query_params)
        user_faculty = query.get()
        user_faculty.student_netIDs.append(sf.student_netID)
        

        hello = {'student_netID':sf.student_netID, 'form_type':sf.form_type}
        time.sleep(.1)
        self.redirect('/forms/view?' + urllib.urlencode(hello))

class CheckPointFormPage(webapp2.RequestHandler):

    def get(self):

        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
            }
        template = JINJA_ENVIRONMENT.get_template('checkpointform.html')
        self.response.write(template.render(template_values))

    def post(self):
        ##### FIX ADVISOR NET ID (HARDWIRED), ALSO CHANGE ADVISOR IN CHECKPOINT FORMS TO ADVISOR_NAME


        cpf = None
        if getCurrentUser(self).user_type == "student":
            cpf = CheckpointForm(student_name=self.request.get('student_name'),
                                 form_type= 'checkpoint',
                                 topic_title = self.request.get('topic_title'),
                                 advisor_name = self.request.get('advisor'),                              
                                 meetings_w_advisor = int(self.request.get('meetings_w_advisor')),
                                 self_assessment = self.request.get('self_assessment'),
                                 student_netID = self.request.get('student_netID'),



                                 )

        elif getCurrentUser(self).user_type  == "faculty":
            query_params = {'student_netID':'myself','form_type':'checkpoint'}
            query = object_query(Form, query_params)
            cpf = query.fetch(1)[0]
            cpf.meet_more_often = bool(self.request.get('meet_more_often'))
            cpf.student_progress = int(self.request.get('student_progress'))
            cpf.comments = self.request.get('comments')
                                                                                           
                                     #submitted = False,
                                #     key_name = self.request.get('student_netID'),


        #self.response.write(getCurrentUser(self))
        #validateFormSubmission(self, cpf)


        cpf.put()
        query_params = {'student_netID':cpf.student_netID, 'form_type':cpf.form_type}
        time.sleep(.1)
        self.redirect('/forms/view?' + urllib.urlencode(query_params))

class SecondReaderFormPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
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
                               student_netID = self.request.get('student_netID'),
                               form_type = 'second_reader'
        )
        validateFormSubmission(self, srf)

class FebruaryFormPage(webapp2.RequestHandler):

    def get(self):
        session = get_current_session()
        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
            #'user_type': session["user"].user_type
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
                          student_netID = self.request.get('student_netID'),
                          form_type = 'february'
        )
        validateFormSubmission(self, ff)

class FormView(webapp2.RequestHandler):
    # this shows the results of what has been submitted
    def get(self):
        # calls helper method
        query_params = build_query_params(self)
        query = object_query(Form, query_params)
        #forms = query.fetch(1)
        form = query.get()
        template_values = {
            'form': form,
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % form.form_type)
        self.response.write(template.render(template_values))
        

class FormQuery(webapp2.RequestHandler):
    # user inputs what he/she wants to query
    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('query.html')
        self.response.write(template.render(template_values))

    def post(self):
        query_params = build_query_params(self)
        self.redirect('/forms/query_results?' + urllib.urlencode(query_params))

class QueryResults(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query = object_query(Form, query_params)
        # sort query results (sort_by is a link selected by the user in query_results.html)
        sort_by = self.request.get('sort_by')
        if sort_by == 'form_type':
            query = query.order(Form.form_type, Form.student_netID, Form.student_name)
        if sort_by == 'student_netID':
            query = query.order(Form.student_netID, Form.student_name)
        if sort_by == 'student_name':
            query = query.order(Form.student_name, Form.student_netID)
        if sort_by == 'advisor_netID':
            query = query.order(Form.advisor_netID, Form.student_netID, Form.student_name)
        if sort_by == 'advisor_name':
            query = query.order(Form.advisor_name, Form.student_netID, Form.student_name)

        current_user = getCurrentUser(self)
        if current_user.user_type == 'student':
            query2 = query.filter(Form.student_netID == current_user.netID)
            forms = query2.fetch()
        elif current_user.user_type == 'faculty':
            query2 = query.filter(Form.advisor_netID == current_user.netID)
        else:
            forms = query.fetch()


        template_values = {
            'forms':forms,
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('query_results.html')
        self.response.write(template.render(template_values))

class QueryView(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query = object_query(Form, query_params)
        form = query.fetch(1)[0]
        template_values = {
            'form':form,
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('view_%s.html' % query_params['form_type'])
        self.response.write(template.render(template_values))

class FormDelete(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query  = object_query(Form, query_params)
        form = query.fetch(1)[0]
        form.key.delete()
        self.redirect('/forms/delete/confirmation')

class FormDeleteConfirmation(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        template_values = {
            'current_user': getCurrentUser(self),
#            'student_netID':query_params['student_netID'],
 #           'form_type':query_params['form_type']
        }
        template = JINJA_ENVIRONMENT.get_template('form_delete_confirmation.html')
        self.response.write(template.render(template_values))

class FormInvalid(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        template_values = {
            'current_user': getCurrentUser(self),
#            'student_netID': query_params['student_netID'],
            'form_type': query_params['form_type']
        }
        template = JINJA_ENVIRONMENT.get_template('form_invalid.html')
        self.response.write(template.render(template_values))

class NewFile(webapp2.RequestHandler):

    def get(self):

        upload_url = blobstore.create_upload_url('/upload')
        template_values = {
            'current_user': getCurrentUser(self),
            'upload_url': upload_url,
        }
        template = JINJA_ENVIRONMENT.get_template('upload.html')
        self.response.write(template.render(template_values))

class UploadHandler(blobstore_handlers.BlobstoreUploadHandler):

    def post(self):
        upload_files = self.get_uploads('uploadField')
        blob_info = upload_files[0]
        self.redirect('/serve/%s' % blob_info.key())

class Success(webapp2.RequestHandler):

    def get(self):
        self.response.write("Success!")

class ServeHandler(blobstore_handlers.BlobstoreDownloadHandler):

    def get(self, resource):
        resource = str(urllib.unquote(resource))
        blob_info = blobstore.BlobInfo.get(resource)
        self.send_blob(blob_info)

class ViewFiles(blobstore_handlers.BlobstoreDownloadHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('view_files.html')
        self.response.write(template.render(template_values))
#        self.send_blob(blob_info.key())

class Unauthorized(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('unauthorized.html')
        self.response.write(template.render(template_values))

class ViewUsers(webapp2.RequestHandler):

    def get(self):
        session = get_current_session()
        if session['user'].user_type != 'administrator':
            self.redirect('/unauthorized')
        query_params = {} # empty because we want all users
        query = object_query(User, query_params)
        users = query.fetch()
        template_values = {
            'users':users,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('users.html')
        self.response.write(template.render(template_values))

    def post(self):
        action = self.request.get('action')
        if action == 'add':
            user_type = self.request.get('user_type')
            user_netID = self.request.get('user_netID')
            if user_type == 'student':
                user = Student(netID=user_netID, user_type='student')
            elif user_type == 'faculty':
                user = Faculty(netID=user_netID, user_type='faculty')
            else: # user_type == 'administrator':
                user = Administrator(netID=user_netID, user_type='administrator')
            validateNewUser(self, user)

class UserInvalid(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query  = object_query(User, query_params)
        user = query.fetch(1)[0]
        template_values = {
            'user': user,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_invalid.html')
        self.response.write(template.render(template_values))

class UserDelete(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        query  = object_query(User, query_params)
        user = query.fetch(1)[0]
        user.key.delete()
        self.redirect('/administrative/user_delete/confirmation?' + urllib.urlencode(query_params))

class UserDeleteConfirmation(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        template_values = {
            'netID': query_params['netID'],
            'user_type': query_params['user_type'],
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_delete_confirmation.html')
        self.response.write(template.render(template_values))

class UserView(webapp2.RequestHandler):
    # this shows the results of what has been submitted
    def get(self):
        # calls helper method
        query_params = build_query_params(self)
        query = object_query(User, query_params)
        users = query.fetch(1)
        user = users[0]

        template_values = {
            'user': user,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_view.html')
        self.response.write(template.render(template_values))

class UserUpload(webapp2.RequestHandler):

    def get(self):
        upload_url = blobstore.create_upload_url('/upload')
        template_values = {
            'upload_url':upload_url,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_upload.html')
        self.response.write(template.render(template_values))

class ViewMessages(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'messages': getMessages(self),
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('messages.html')
        self.response.write(template.render(template_values))

    def post(self):
        message = Message(author_netID=getCurrentUser(self).netID,
                          content=self.request.get("content")
                      )
        message.put()
        time.sleep(0.1)
        self.redirect('messages')

application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/login', LoginPage),
    ('/logout', LogoutPage),
    ('/login/unauthorized', LoginUnauthorizedPage),
    ('/unauthorized', Unauthorized),
    ('/forms/signupform', SignupFormPage),
    ('/forms/secondreaderform', SecondReaderFormPage),
    ('/forms/checkpointform', CheckPointFormPage),
    ('/forms/februaryform', FebruaryFormPage),
    ('/forms/view', FormView),
    ('/forms/query', FormQuery),
    ('/forms/query_results', QueryResults),
    ('/forms/query_view', QueryView),
    ('/forms/delete', FormDelete),
    ('/forms/delete/confirmation', FormDeleteConfirmation),
    ('/forms/invalid_entry', FormInvalid),
    ('/files/new_file', NewFile),
    ('/upload', UploadHandler),
    ('/serve/([^/]+)?', ServeHandler),
    ('/files/view', ViewFiles),
    ('/administrative/users', ViewUsers),
    ('/administrative/user_delete', UserDelete),
    ('/administrative/user_delete/confirmation', UserDeleteConfirmation),
    ('/administrative/user_view', UserView),
    ('/administrative/invalid_entry', UserInvalid),
    ('/messages', ViewMessages),
    ('/user_upload', UserUpload),

], debug=True)

def main():
#    run_wsgi_app(webapp_add_wsgi_middleware(application))
    run_wsgi_app(application)

if __name__ == "__main__":
    main()
