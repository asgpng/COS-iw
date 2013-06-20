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

class FebruaryFormPageView(webapp2.RequestHandler):
        
p    def get(self):

        query = FebruaryForm.query(SignupForm.class_year==1999)
        ff = query.fetch(1)

        if users.get_current_user():
            url = users.create_logout_url(self.request.uri)
            url_linktext = 'Logout'
        else:
            url = users.create_login_url(self.request.uri)
            url_linktext = 'Login'

        template_values = {
            'ff': ff,
            'url': url,
            'url_linktext': url_linktext,
        }
        template = JINJA_ENVIRONMENT.get_template('signup_form_view.html')
        self.response.write(template.render(template_values))

    ('/forms/februaryform', FebruaryFormPage),
    ('/forms/februaryform/view', FebruaryFormPageView),
