from app import app, db
from models import *
from forms import *
from methods import *
from flask import render_template, request, session, g, redirect, url_for, flash
from flask.ext.babel import gettext
from datetime import datetime
import time
import CASClient



TIME_SLEEP = 0.1

@app.before_request
def before_request():
    g.user = User.query.first() # mock user for debugging

# general links
@app.route('/')
@app.route('/index')
@template('index.html')
def index():
    return dict(title = "Home")

# still needs to be debugged (with error logs?)
@app.route('/cas-login')
def cas_login():
    C = CASClient.CASClient()
    netID = C.Authenticate()
    user = User.query.filter(User.netID == netID).first()
    if user != None:
        current_user = user
    else:
        current_user = User(netID=netID, user_type = 'default')
        db.session.add(current_user)
        db.session.commit()
    session['user'] =  current_user
    return redirect(url_for('/'))

@app.route('/about')
@template('about.html')
def about():
    return dict(title='about',)

@app.route('/contact')
@template('contact.html')
def contact():
    return dict(title = 'Contact',)

@app.route('/test')
@template('test/test.html')
def test():
    return dict(title = 'test',)

@app.route('/form-test', methods = ['GET', 'POST'])
# @template('form_test.html')
def form_test():
    # form = SignupForm()
    # if form.validate_on_submit():
    #     sf = Signup(form_type="signup",
    #                 student_netID=form.student_netID,
    #                 student_name=form.student_name,
    #                 class_year=form.class_year,
    #                 coursework=form.coursework,
    #                 title=form.title,
    #                 description=form.description,
    #                 advisor_name=form.advisor_name,
    #                 advisor_netID=form.advisor_netID,
    #                 advisor_department=form.advisor_department,
    #                 student_signature=form.student_signature,
    #                 date=datetime.now(),
    #             )
    form = SignupForm()
    if form.validate_on_submit():
        sf = Form(form_type="signup",
                  student_netID=form.student_netID,
                  student_name=form.student_name,
                  title=form.title,
                  description=form.description,
                  advisor_name=form.advisor_name,
                  advisor_netID=form.advisor_netID,
                  date=datetime.now(),
        )

        db.session.add(sf)
        # db.session.commit()
        flash('Your form has been successfully submitted.')
        # return redirect(url_for('index'))
        app.logger.debug(form.errors)
        return redirect(url_for('index'))
    return render_template("forms/test.html",
                               form = form,
                           )


@app.route('/login')
@template('login.html')
def login():
    if request.method == 'GET':
        return dict(title = 'Login',)
    else:

        if g.user is not None:
            return redirect(url_for('index'))

@app.route('/logout')
@template('logout.html')
def logout():
    return dict(title = 'Logout',)

@app.route('/login/unauthorized')
@template('login_unauthorized')
def login_unauthorized():
    return dict(title = 'Login Unauthorized',)

@app.route('/unauthorized')
@template('unauthorized.html')
def unauthorized():
    return dict(title = 'Unauthorized',)

# forms

@app.route('/forms/signup')
@template('forms/signup.html')
def form_signup():
    return dict(title = 'Signup Form',)

@app.route('/forms/second_reader')
@template('forms/second_reader.html')
def form_second_reader():
    return dict(title = 'Second Reader Form',)

@app.route('/forms/checkpoint')
@template('forms/second_reader.html')
def form_checkpoint():
    return dict(title = 'Second Reader Form',)

@app.route('/forms/february')
@template('forms/february.html')
def form_february():
    return dict(title = 'February Form',)

@app.route('/forms/view/<form_type>')
def form_view(form_type):
    # need to pass form
    return render_template('forms/view/%s.html' % form_type,
                           title='Form View')

@app.route('/forms/query')
@template('forms/query.html')
def form_query():
    return dict(title = 'Form Query',)

@app.route('/forms/query/view')
def form_query_results():
    return render_template("forms/view/query.html",
                           title = "Form Query Results",
    )

@app.route('/forms/delete')
@template('forms/form_delete.html')
def form_delete():
    return dict(title = 'Form Delete',)

@app.route('/forms/delete/confirmation')
@template('forms/delete_confirmation.html')
def form_delete_confirmation():
    return dict(title = 'Form Delete Confirmation',)

@app.route('/forms/invalid_entry')
@template('forms/invalid.html')
def form_invalid_entry():
    return dict(title = 'Form Invalid Entry',)

@app.route('/forms/signup_not_allowed')
@template('forms/signup_not_allowed.html')
def form_signup_not_allowed():
    return dict(title = 'Signup Not Allowed',)

@app.route('/forms/approve_advisees')
@template('forms/approve_advisees.html')
def form_approve_advisees():
    return dict(title = 'Approve Advisees',)

# files
@app.route('/files/upload')
@template('files/upload.html')
def files_upload():
    return dict(title = 'Upload File',)

@app.route('/files/view/list')
@template('files/view/list.html')
def files_view_list():
    return dict(title = 'Uploaded Files',)

@app.route('/files/view/single')
@template('files/view/single.html')
def files_view_single():
    return dict(title = 'Uploaded File',)

@app.route('/files/delete')
@template('files/delete.html')
def files_delete():
    return dict(title = 'Delete Files',)

# admin
@app.route('/admin/users', methods=['GET', 'POST'])
@template('admin/users.html')
def users_view():
    if request.method == 'POST':
        return "hello"
    else:
        return dict(title = 'users',)

@app.route('/admin/user_delete')
@template('admin/user_delete.html')
def users_delete():
    return dict(title = 'Delete Users',)

@app.route('/admin/user_delete/confirmation')
@template('admin/user_delete_confirmation.html')
def users_delete_confirmation():
    return dict(title = 'Delete Users',)

@app.route('/admin/user_view')
@template('admin/user_view.html')
def users_view_single():
    return dict(title = 'User Profile',)

@app.route('/admin/user_invalid')
@template('admin/user_invalid.html')
def users_invalid():
    return dict(title = 'Invalid User',)

@app.route('/admin/user_upload')
@template('admin/<user_upload.html')
def users_upload():
    return dict(title = 'Upload User List',)

@app.route('/admin/user_process_upload',methods = ['POST'])
# @template('user_process_upload.html')
def users_process_upload():
    # return dict(title = 'Process User List',)
    # process logic
    pass

# messages
@app.route('/messages')
@template('messages.html')
def messages():
    return dict(title = 'Messages',)
