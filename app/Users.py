from google.appengine.ext import ndb

# for when we get netIDs working
class Student(ndb.Model):
    netID = ndb.StringProperty()
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="student")
    advisor_netID = ndb.StringProperty()
    second_reader_netID = ndb.StringProperty()

class Advisor(ndb.Model):
    netID = ndb.StringProperty()
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="advisor")
    student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs

class SecondReader(ndb.Model):
    netID = ndb.StringProperty()
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="second_reader")
    student_netIDs = ndb.StringProperty(repeated=True)   # list of student netIDs

class Administrator(ndb.Model):
    netID = ndb.StringProperty()
    email = ndb.StringProperty()
    user_type = ndb.StringProperty(default="administrator")
