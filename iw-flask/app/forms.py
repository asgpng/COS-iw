from flask.ext.wtf import Form, TextField, BooleanField, TextAreaField, IntegerField, RadioField, SelectField
from flask.ext.wtf import Required, Length
# from flask.ext.babel import gettext
from app.models import User

# class LoginForm(Form):
#     netID = TextField('netID', validators = [Required()])
#     remember_me = BooleanField('remember_me', default = False)

departments = [
("ANT","Anthropology"),
("ARC","Architecture"),
("ART","Art and Archaeology"),
("AST","Astrophysical Sciences"),
("CBE","Chemical and Biological Engineering"),
("CHE","Chemistry"),
("CEE","Civil and Environmental Engineering"),
("CLA","Classics"),
("COM","Comparative Literature"),
("COS","Computer Science"),
("EAS","East Asian Studies"),
("EEB","Ecology and Evolutionary Biology"),
("ECO","Economics"),
("ELE","Electrical Engineering"),
("ENG","English"),
("FIT","French and Italian"),
("GEO","Geosciences"),
("GER","German"),
("HIS","History"),
("MAT","Mathematics"),
("MAE","Mechanical and Aerospace Engineering"),
("MOL","Molecular Biology"),
("MUS","Music"),
("NES","Near Eastern Studies"),
("ORF","Operations Research and Financial Engineering"),
("PHI","Philosophy"),
("PHY","Physics"),
("POL","Politics"),
("PSY","Psychology"),
("REL","Religion"),
("SLA","Slavic Languages and Literatures"),
("SOC","Sociology"),
("SPO","Spanish and Portuguese"),
("WWS","Woodrow Wilson School")
]

class BaseForm(Form):
    # possibly include u: as in first_name = TextField(u'First Name')
    form_type = TextField('form_type')
    student_netID = TextField('student_netID', validators = [Required()])
    student_name = TextField('student_name', validators = [Required()])
    advisor_netID = TextField('advisor_netID', validators = [Required()])
    advisor_name = TextField('student_name', validators = [Required()])
    description = TextField('description')
    title = TextField('title')

class SignupForm(BaseForm):
    class_year = IntegerField('class_year', validators = [Required()])
    coursework = RadioField('coursework', choices=[('397', '397'), ('398','398'), ('497', '497'), ('498', '498'), ('AB JIW', 'AB JIW'), ('AB Senior Thesis', 'AB Senior Thesis'), ('BSE Senior Thesis', 'BSE Senior Thesis')], validators = [Required()])
    advisor_netID = TextField('advisor_netID', validators = [Required()])
    advisor_department = SelectField('advisor_department', choices=departments, default="COS", validators = [Required()])
    advisor_signature = BooleanField('advisor_signature')
    student_signature = BooleanField('student_signature', validators = [Required()])
