from google.appengine.ext import ndb

# for when we get netIDs working
class Student(ndb.Model):
    netID = ndb.StringProperty(required=True)
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="student")
    advisor_netID = ndb.StringProperty()
    second_reader_netID = ndb.StringProperty()
    forms_submitted = ndb.StringProperty(repeated=True)  # list of submitted forms

class Faculty(ndb.Model):
    netID = ndb.StringProperty(required=True)
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="faculty")
    student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs

class Administrator(ndb.Model):
    netID = ndb.StringProperty(required=True)
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="administrator")
