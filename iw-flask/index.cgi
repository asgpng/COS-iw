#!modules/bin/python

from wsgiref.handlers import CGIHandler
from app import app

import cgitb
cgitb.enable(logdir="/u/asg4/public_html/logs")

CGIHandler().run(app)
