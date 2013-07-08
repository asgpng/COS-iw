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
from app.user_parser import *


JINJA_ENVIRONMENT = jinja2.Environment(
    loader=jinja2.FileSystemLoader(os.path.dirname(__file__)),
    extensions=['jinja2.ext.autoescape'])

# update jinja filter:
JINJA_ENVIRONMENT.filters['urlencode'] = do_urlencode
JINJA_ENVIRONMENT.filters['validateNetID'] = validateNetID

TIME_SLEEP = 0.1 # default lenth of time to wait before redirects

# Fix wrong netID redirect in signupform
# Fix approval netID issue
# # maybe use in the future for code simplification
# class BaseHandler(webapp2.RequestHandler):

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
       # elif len(users) == 0:
        #    self.redirect('login/unauthorized?'+urllib.urlencode(query_params))
        else:
            # # for hacking purposes only
            user = User(netID="admin", user_type="administrator")
            # user.put()
            #user = query.get()
            session['user'] = user
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
            }
            template = JINJA_ENVIRONMENT.get_template('index.html')
            self.response.write(template.render(template_values))

class About(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('about.html')
        self.response.write(template.render(template_values))

class Contact(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('contact.html')
        self.response.write(template.render(template_values))


class SignupFormPage(webapp2.RequestHandler):
    # get information from the user
    def get(self):

        user = getCurrentUser(self)
        if user.user_type == "faculty":
            self.redirect('/forms/signupnotallowed')

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
        
        advisor_verified = validateNetID(sf.advisor_netID)
        
        if advisor_verified:
            sf.put()
            current_user = getCurrentUser(self)
            current_user.advisor_netID = sf.advisor_netID

            query_params = {'netID': sf.advisor_netID}
            query = object_query(Faculty, query_params)
            user_faculty = query.get()
            user_faculty.student_requests.append(sf.student_netID)
            user_faculty.student_requests.sort
            user_faculty.put()

            query_params2 = {'student_netID':sf.student_netID, 'form_type':sf.form_type}
            time.sleep(.1)
            self.redirect('/forms/view?' + urllib.urlencode(query_params2))

        else:
            self.redirect('/forms/signup')
        # might be able to delete this line b/c its in validate method
        sf.put()

        current_user = getCurrentUser(self)
        current_user.advisor_netID = sf.advisor_netID

        query_params = {'netID': sf.advisor_netID}
        query = object_query(Faculty, query_params)
        user_faculty = query.get()
        user_faculty.student_requests.append(sf.student_netID)
        user_faculty.student_requests.sort
        user_faculty.put()

        validateFormSubmission(self, sf, current_user)


class SignUpNotAllowed(webapp2.RequestHandler):
    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('signup_not_allowed.html')
        self.response.write(template.render(template_values))

class CheckPointFormPage(webapp2.RequestHandler):

    def get(self):
        current_user = getCurrentUser(self)




        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
            }
        template = JINJA_ENVIRONMENT.get_template('checkpointform.html')
        self.response.write(template.render(template_values))

    def post(self):
        cpf = None
        # get rid of put() methods b/c they're in helper_methods?
        current_user = getCurrentUser(self)
        if current_user.user_type == "student":
            cpf = CheckpointForm(student_name=self.request.get('student_name'),
                                 form_type= 'checkpoint',
                                 topic_title = self.request.get('topic_title'),
                                 advisor_name = self.request.get('advisor'),
                                 meetings_w_advisor = int(self.request.get('meetings_w_advisor')),
                                 self_assessment = self.request.get('self_assessment'),
                                 student_netID = self.request.get('student_netID'),
                                 )
            cpf.put()

        elif current_user.user_type  == "faculty":
            query_params = {'student_netID': self.request.get('choose_student'),'form_type':'checkpoint'}
            query = object_query(Form, query_params)
            cpf = query.get()
            cpf.advisor_read_summary = self.request.get('advisor_read_summary')
            cpf.meet_more_often = self.request.get('meet_more_often')
            cpf.student_progress = int(self.request.get('student_progress'))
            cpf.comments = self.request.get('comments')
            cpf.choose_student = self.request.get('choose_student')

        validateFormSubmission(self, cpf, current_user)

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

        current_user = getCurrentUser(self)
        srf = None
        if current_user.user_type == 'student':
            srf = SecondReaderForm(student_name=self.request.get('student_name'),
                                   student_netID = self.request.get('student_netID'),
                                   class_year =int(self.request.get('class_year')),
                                   title = self.request.get('title'),
                                   description = self.request.get('description'),
                                   advisor_name = self.request.get('advisor_name'),
                                   advisor_netID = self.request.get('advisor_netID'),
                                   sr_name = self.request.get('sr_name'),
                                   sr_netID = self.request.get('sr_netID'),
                                   sr_department = self.request.get('sr_department'),
                                   form_type = 'second_reader'
                                   )
            srf.put()
            query_params = {'netID': srf.sr_netID}
            query = object_query(Faculty, query_params)
            user_faculty = query.get()
            # Right now we append it to general requests.
            # IS it worth it to specify? How will we distinguish?
            user_faculty.student_requests.append(srf.student_netID)
            user_faculty.put()
        # Broken because there is no choose_students
        elif current_user.user_type == 'faculty':
            query_params = {'student_netID': self.request.get('choose_student'), 'form_type': 'second_reader'}
            query = object_query(Form, query_params)
            srf = query.get()
            srf.sr_agreement = self.request.get('sr_agreement')
            srf.sr_signature = self.request.get('sr_signature')

        validateFormSubmission(self, srf, current_user)


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
        ff = None
        current_user = getCurrentUser(self)
        if current_user.user_type == 'student':
            ff = FebruaryForm(student_name = self.request.get('student_name'),
                              title = self.request.get('title'),
                              description = self.request.get('description'),
                              advisor_name = self.request.get('advisor_name'),
                              advisor_netID = self.request.get('advisor_netID'),
                              number_of_meetings = int(self.request.get('number_of_meetings')),
                              student_comments = self.request.get('student_comments'),
                              student_netID = self.request.get('student_netID'),
                              form_type = 'february'
                              )

        elif current_user.user_type == 'faculty':
            query_params = {'student_netID': self.request.get('choose_student'), 'form_type':'february_form'}
            query = object_query(Form, query_params)
            ff = query.fetch(1)[0]
            ff.advisor_read = bool(self.request.get('advisor_read')),
            ff.advisor_more_meetings = bool(self.request.get('advisor_more_meetings')),
            ff.student_progress_eval = int(self.request.get('student_progress_eval')),
            ff.advisor_comments = self.request.get('advisor_comments')


        validateFormSubmission(self, ff, current_user)

class ApproveAdvisees(webapp2.RequestHandler):
    def get(self):

        current_user = getCurrentUser(self)
        if current_user.user_type == "student":
            self.redirect('/denied/')

        template_values = {
            'current_user': getCurrentUser(self),
            'url_linktext': getLoginStatus(self.request.uri)[1],
        }
        template = JINJA_ENVIRONMENT.get_template('approve.html')
        self.response.write(template.render(template_values))

    def post(self):
        current_user = getCurrentUser(self)

        approval = self.request.get('approve')
        student = self.request.get('chosen_student')
        if approval == 'yes':
            current_user.student_netIDs.append(student)


        current_user.student_requests.remove(student)
        #self.redirect('/')
        current_user.put()
        self.response.write(current_user.student_netIDs)

class FormView(webapp2.RequestHandler):
    # this shows the results of what has been submitted
    def get(self):
        # calls helper method
        query_params = build_query_params(self)
        query = object_query(Form, query_params)
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

class FormQueryResults(webapp2.RequestHandler):

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

class FormQueryView(webapp2.RequestHandler):

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
            # 'student_netID':query_params['student_netID'],
            # 'form_type':query_params['form_type']
        }
        template = JINJA_ENVIRONMENT.get_template('form_delete_confirmation.html')
        self.response.write(template.render(template_values))

class FormInvalid(webapp2.RequestHandler):

    def get(self):
        query_params = build_query_params(self)
        template_values = {
            'current_user': getCurrentUser(self),
            # 'student_netID': query_params['student_netID'],
            'form_type': query_params['form_type']
        }
        template = JINJA_ENVIRONMENT.get_template('form_invalid.html')
        self.response.write(template.render(template_values))

class NewFile(webapp2.RequestHandler):

    def get(self):

        upload_url = blobstore.create_upload_url('/files/upload')
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
        current_user = getCurrentUser(self)
        blob = Blob(author_netID=current_user.netID,
                    blob_prop=str(blob_info.key()),
                    blob_key=blob_info.key(),
                    filename=self.request.get('filename'),
                    extension=self.request.get('extension'),
                    upload_type=self.request.get('upload_type'),
                )
        blob.put()
        time.sleep(TIME_SLEEP)
        if blob.upload_type=='user_list':
            self.redirect('/admin/user_process_upload')
        else:
            self.redirect('/files/view_list')

class ServeHandler(blobstore_handlers.BlobstoreDownloadHandler):

    def get(self, resource):
        resource = str(urllib.unquote(resource))
        blob_info = blobstore.BlobInfo.get(resource)
        self.send_blob(blob_info)
        #self.redirect('/view_files')

class UploadFile(webapp2.RequestHandler):
    def post(self):
        newfile = File()
        newfile.filename = self.request.get('filename')
        newfile.ext = self.request.get('ext')
        newfile.content = self.request.get('upload')
        newfile.put()
        self.redirect('/files/view_list')

class FileViewList(blobstore_handlers.BlobstoreDownloadHandler):

    def get(self):
        blobs = object_query(Blob, {}).fetch()
        template_values = {
            'current_user': getCurrentUser(self),
            'blobs':blobs,
        }
        template = JINJA_ENVIRONMENT.get_template('view_files.html')
        self.response.write(template.render(template_values))

class FileViewSingle(blobstore_handlers.BlobstoreDownloadHandler):

    def get(self):
        query_params = {'blob_prop':str(urllib.unquote(self.request.get('blob_key')))}
        blob = object_query(Blob, query_params).get()
        blob_reader = blobstore.BlobReader(blob.blob_key)
        file = blob_reader.readlines()
        self.response.write('<br>')

        for line in file:
            self.response.write(line)
            self.response.write('<br>')
        template_values = {
            'current_user': getCurrentUser(self),
            'blob':blob,
            'file':file,
        }
        template = JINJA_ENVIRONMENT.get_template('view_files.html')
        self.response.write(template.render(template_values))

class FileDelete(webapp2.RequestHandler):

    def get(self):
        query_params = {'blob_prop':str(urllib.unquote(self.request.get('blob_key')))}
        file = object_query(Blob, query_params).get()
        blob = BlobInfo(file.blob_key)
        blob.delete()
        file.key.delete()
        time.sleep(TIME_SLEEP)
        self.redirect('/files/view_list')

class UserProcessUpload(webapp2.RequestHandler):

    def get(self):
        query_params = {'upload_type':'user_list'}
        blob = object_query(Blob, query_params).get() #eventually make sure to overwrite old list
        blob_reader = blobstore.BlobReader(blob.blob_key)
        file = blob_reader.readlines()
        user_list = []
        added_users = []

        for line in file:
            user_list.append(line.strip().split(','))
        for user in user_list[1:]: # omit header line
            netID = user[0]
            user_type=user[1]
            if object_query(User, {'netID':netID, 'user_type':user_type}).get()==None:
                new_user = User(netID=netID, user_type=user_type)
                added_users.append(new_user)
                new_user.put()
        # self.response.write(added_users)
        template_values = {
            'current_user': getCurrentUser(self),
            'added_users': added_users
        }
        template = JINJA_ENVIRONMENT.get_template('user_list.html')
        self.response.write(template.render(template_values))

class Unauthorized(webapp2.RequestHandler):

    def get(self):
        template_values = {
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('unauthorized.html')
        self.response.write(template.render(template_values))

class UserView(webapp2.RequestHandler):

    def get(self):
        session = get_current_session()
        if session['user'].user_type != 'administrator':
            self.redirect('/unauthorized')
        query_params = {} # empty because we want all users
        query = object_query(User, query_params)

        # sort users results (sort_by is a link selected by the user in users.html)
        sort_by = self.request.get('sort_by')
        if sort_by == 'user_type':
            query = query.order(User.user_type)
        if sort_by == 'netID':
            query = query.order(User.netID)

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
        self.redirect('/admin/user_delete/confirmation?' + urllib.urlencode(query_params))

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

class UserViewSingle(webapp2.RequestHandler):
    # this shows the results of what has been submitted
    def get(self):
        # calls helper method
        query_params = build_query_params(self)
        query = object_query(User, query_params)
        user = query.get()

        template_values = {
            'user': user,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_view.html')
        self.response.write(template.render(template_values))

class UserUpload(webapp2.RequestHandler):

    def get(self):
        upload_url = blobstore.create_upload_url('/files/upload')
        template_values = {
            'upload_url':upload_url,
            'current_user': getCurrentUser(self),
        }
        template = JINJA_ENVIRONMENT.get_template('user_upload.html')
        self.response.write(template.render(template_values))

class MessageView(webapp2.RequestHandler):

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
        time.sleep(TIME_SLEEP)
        self.redirect('messages')

class ErrorPage(webapp2.RequestHandler):

    def get(self):
        template_values = {
            #'messages': getMessages(self),
            #'current_user': getCurrentUser(self),
            }
        template = JINJA_ENVIRONMENT.get_template('error.html')
        self.response.write(template.render(template_values))

    

application = webapp2.WSGIApplication([
    ('/', MainPage),
    ('/about', About),
    ('/contact', Contact),
    ('/login', LoginPage),
    ('/logout', LogoutPage),
    ('/login/unauthorized', LoginUnauthorizedPage),
    ('/unauthorized', Unauthorized),
    ('/forms/signup', SignupFormPage),
    ('/forms/second_reader', SecondReaderFormPage),
    ('/forms/checkpoint', CheckPointFormPage),
    ('/forms/february', FebruaryFormPage),
    ('/forms/view', FormView),
    ('/forms/query', FormQuery),
    ('/forms/query_results', FormQueryResults),
    ('/forms/query_view', FormQueryView),
    ('/forms/delete', FormDelete),
    ('/forms/delete/confirmation', FormDeleteConfirmation),
    ('/forms/invalid_entry', FormInvalid),
    ('/files/new_file', NewFile),
    ('/files/upload', UploadHandler),
    # ('/upload', UploadFile),
    ('/serve/([^/]+)?', ServeHandler),
    ('/files/view_list', FileViewList),
    ('/files/view_single',FileViewSingle),
    ('/files/delete', FileDelete),
    ('/admin/users', UserView),
    ('/admin/user_delete', UserDelete),
    ('/admin/user_delete/confirmation', UserDeleteConfirmation),
    ('/admin/user_view', UserViewSingle),
    ('/admin/invalid_entry', UserInvalid),
    ('/admin/user_upload', UserUpload),
    ('/admin/user_process_upload', UserProcessUpload),
    ('/messages', MessageView),
    ('/forms/signupnotallowed', SignUpNotAllowed),
    ('/forms/approve', ApproveAdvisees),
    ('/error', ErrorPage)

], debug=True)

def main():
#    run_wsgi_app(webapp_add_wsgi_middleware(application))
    run_wsgi_app(application)

if __name__ == "__main__":
    main()
