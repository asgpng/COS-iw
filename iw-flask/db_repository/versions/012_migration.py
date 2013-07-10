from sqlalchemy import *
from migrate import *


from migrate.changeset import schema
pre_meta = MetaData()
post_meta = MetaData()
checkpoint_form = Table('checkpoint_form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('meetings_w_advisor', Integer),
    Column('self_assessment', String),
    Column('advisor_read_summary', Boolean),
    Column('meet_more_often', Boolean),
    Column('student_progress', Integer),
    Column('comments', String),
)

february_form = Table('february_form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('number_of_meetings', Integer),
    Column('student_comments', String),
    Column('advisor_signature', Boolean),
    Column('advisor_read', Boolean),
    Column('advisor_more_meetings', Boolean),
    Column('student_progress_eval', Integer),
    Column('advisor_comments', String),
)

second_reader_form = Table('second_reader_form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('class_year', Integer),
    Column('description', String),
    Column('sr_name', String),
    Column('sr_netID', String),
    Column('sr_department', String),
    Column('sr_agreement', Boolean),
    Column('sr_signature', String),
)

user = Table('user', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('netID', String(length=20)),
    Column('user_type', String(length=20)),
    Column('advisor_netID', String(length=20)),
    Column('second_reader_netID', String(length=20)),
)


def upgrade(migrate_engine):
    # Upgrade operations go here. Don't create your own engine; bind
    # migrate_engine to your metadata
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['checkpoint_form'].create()
    post_meta.tables['february_form'].create()
    post_meta.tables['second_reader_form'].create()
    post_meta.tables['user'].columns['advisor_netID'].create()
    post_meta.tables['user'].columns['second_reader_netID'].create()


def downgrade(migrate_engine):
    # Operations to reverse the above upgrade go here.
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    post_meta.tables['checkpoint_form'].drop()
    post_meta.tables['february_form'].drop()
    post_meta.tables['second_reader_form'].drop()
    post_meta.tables['user'].columns['advisor_netID'].drop()
    post_meta.tables['user'].columns['second_reader_netID'].drop()
