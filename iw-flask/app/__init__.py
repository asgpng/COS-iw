from flask import Flask
from flask.ext.sqlalchemy import SQLAlchemy
from app.blueprints import forms

app = Flask(__name__)
app.register_blueprint(forms, url_prefix='/forms')
app.config.from_object('config')
db = SQLAlchemy(app)

from app import views, models
