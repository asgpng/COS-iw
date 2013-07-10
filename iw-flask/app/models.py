# from google.appengine.ext import ndb
# from google.appengine.ext.ndb import polymodel
from app import app, db

class Form(db.Model):
    __tablename__ = 'form'
    id = db.Column(db.Integer, primary_key = True)
    form_type = db.Column(db.String(20))
    student_netID = db.Column(db.String(20))
    student_name  = db.Column(db.String(128))
    advisor_netID = db.Column(db.String(20))
    advisor_name  = db.Column(db.String(128))
    title = db.Column(db.String(128))
    description = db.Column(db.String())
    date = db.Column(db.DateTime())

    __mapper_args__ = {
        'polymorphic_identity':'form',
        # 'polymorphic_on':type
    }

    def __repr__(self):
        return '<Form ID: %r, type: %r>' % (self.id, self.form_type)

class Signup(Form):
    __tablename__ = 'signup_form'
    id = db.Column(db.Integer, db.ForeignKey('form.id'), primary_key=True)
    class_year = db.Column(db.Integer)
    coursework = db.Column(db.String(20))
    # choices=set(["397", "398", "497", "498", "AB JIW", "AB Senior Thesis", "BSE Senior Thesis"]))
    advisor_signature = db.Column(db.Boolean())
    advisor_department = db.Column(db.String(128)) #
    student_signature = db.Column(db.Boolean())

    __mapper_args__ = {
        'polymorphic_identity':'signup_form'
    }

class Checkpoint(Form):
    __tablename__ = 'checkpoint_form'
    id = db.Column(db.Integer, db.ForeignKey('form.id'), primary_key=True)
    meetings_w_advisor = db.Column(db.Integer)
    self_assessment = db.Column(db.String())
    advisor_read_summary = db.Column(db.Boolean())
    meet_more_often = db.Column(db.Boolean())
    student_progress = db.Column(db.Integer()) #(choices=set([4, 3, 2, 1]))
    comments = db.Column(db.String())

class February(Form):
    __tablename__ = 'february_form'
    id = db.Column(db.Integer, db.ForeignKey('form.id'), primary_key=True)
    number_of_meetings = db.Column(db.Integer)
    student_comments = db.Column(db.String())
    advisor_signature = db.Column(db.Boolean())
    advisor_read = db.Column(db.Boolean())
    advisor_more_meetings = db.Column(db.Boolean())
    student_progress_eval = db.Column(db.Integer) #(choices=set([1,2,3]))
    advisor_comments = db.Column(db.String())

class SecondReader(Form):
    id = db.Column(db.Integer, db.ForeignKey('form.id'), primary_key=True)
    __tablename__ = 'second_reader_form'
    class_year = db.Column(db.Integer)
    description = db.Column(db.String())
    sr_name = db.Column(db.String())
    sr_netID = db.Column(db.String())
    sr_department = db.Column(db.String())
    sr_agreement = db.Column(db.Boolean())
    sr_signature = db.Column(db.String())

# class User(db.Model):
#     netID = db.Column(db.String(20), primary_key = True)
#     user_type = db.Column(db.String(20), index=True)

class User(db.Model):
    id = db.Column(db.Integer, primary_key = True)
    netID = db.Column(db.String(20), index=True)
    user_type = db.Column(db.String(20), index=True)

class Student(User):
    advisor_netID = db.Column(db.String(20))
    second_reader_netID = db.Column(db.String(20))

# class Faculty(User):
    # how to get lists with sqlalchemy?


# # for when we get netIDs working
# class Student(User):
#     advisor_netID = ndb.StringProperty()
#     second_reader_netID = ndb.StringProperty()
#     forms_submitted = ndb.StringProperty(repeated=True)  # list of submitted forms

# class Faculty(User):
#     student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs

# class Administrator(User):
#     student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs
