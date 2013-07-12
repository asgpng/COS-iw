from app import app as application
import sys
sys.path.insert(0, '/srv/http/iw-flask')

activate_this = '/srv/http/iw-flask/modules/bin/activate_this.py'
execfile(activate_this, dict(__file__=activate_this))

import logging, sys

logging.basicConfig(stream=sys.stderr)


if __name__=='__main__':
    application.run(debug = True)
