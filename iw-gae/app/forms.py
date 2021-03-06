from google.appengine.ext import ndb
from google.appengine.ext.ndb import polymodel

class Form(polymodel.PolyModel):
    form_type = ndb.StringProperty(required=True)
    student_netID = ndb.StringProperty(required=True)
    student_name = ndb.StringProperty()
    advisor_netID = ndb.StringProperty()
    advisor_name = ndb.StringProperty()

class SignupForm(Form):
    # needs form_type, student_name, student_netID, advisor_name, advisor_netID
    class_year = ndb.IntegerProperty()
    coursework = ndb.StringProperty(choices=set(["397", "398", "497", "498", "AB JIW", "AB Senior Thesis", "BSE Senior Thesis"]))
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    advisor_signature = ndb.BooleanProperty()
    advisor_department = ndb.StringProperty()
    student_signature = ndb.BooleanProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)
    # consider adding properties = ndb.PickleProperty() which is a list of the properties of each form

class CheckpointForm(Form):
    topic_title = ndb.StringProperty()
    meetings_w_advisor = ndb.IntegerProperty()
    self_assessment = ndb.StringProperty()
    advisor_read_summary = ndb.BooleanProperty()
    meet_more_often = ndb.BooleanProperty()
    student_progress = ndb.IntegerProperty(choices=set([4, 3, 2, 1]))
    comments = ndb.StringProperty()
    submitted = ndb.BooleanProperty()
    #key_name = ndb.Key(

class FebruaryForm(Form):
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    number_of_meetings = ndb.IntegerProperty()
    student_comments = ndb.StringProperty()
    advisor_signature = ndb.BooleanProperty()
    advisor_read = ndb.BooleanProperty()
    advisor_more_meetings = ndb.BooleanProperty()
    student_progress_eval = ndb.IntegerProperty(choices=set([1,2,3]))
    advisor_comments = ndb.StringProperty()
    submitted = ndb.BooleanProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)

class SecondReaderForm(Form):
    class_year = ndb.IntegerProperty()
    title = ndb.StringProperty()
    description = ndb.StringProperty()
    sr_name = ndb.StringProperty()
    sr_netID = ndb.StringProperty()
    sr_department = ndb.StringProperty()
    sr_agreement = ndb.BooleanProperty()
    sr_signature = ndb.StringProperty()
