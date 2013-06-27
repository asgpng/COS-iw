from google.appengine.ext import ndb
from google.appengine.ext.ndb import polymodel

class User(polymodel.PolyModel):
    netID = ndb.StringProperty(required=True)
    email = ndb.StringProperty()
    user_type = ndb.StringProperty()

# for when we get netIDs working
class Student(User):
    advisor_netID = ndb.StringProperty()
    second_reader_netID = ndb.StringProperty()
    forms_submitted = ndb.StringProperty(repeated=True)  # list of submitted forms

class Faculty(User):
    student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs

class Administrator(User):
    student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs
