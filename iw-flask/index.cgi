#!modules/bin/python

from wsgiref.handlers import CGIHandler
from app import app
import logging, sys

logging.basicConfig(stream=sys.stderr)

import cgitb
cgitb.enable()
# cgitb.enable(logdir="/n/fs/spe-iw/public_html/iw-flask/logs")
# cgitb.enable(logdir="/iw-flask/logs")

CGIHandler().run(app)
