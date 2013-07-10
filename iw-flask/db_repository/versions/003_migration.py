from sqlalchemy import *
from migrate import *


from migrate.changeset import schema
pre_meta = MetaData()
post_meta = MetaData()
migration_tmp = Table('migration_tmp', pre_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('form_type', String),
    Column('student_netID', String),
    Column('advisor_netID', String),
    Column('class_year', Integer),
    Column('coursework', String),
    Column('title', String),
    Column('description', String),
    Column('advisor_signature', Boolean),
    Column('student_signature', Boolean),
    Column('submitted', Boolean),
    Column('date', DateTime),
)

form = Table('form', post_meta,
    Column('id', Integer, primary_key=True, nullable=False),
    Column('form_type', String(length=20)),
    Column('student_netID', String(length=20)),
    Column('student_name', String(length=128)),
    Column('advisor_netID', String(length=20)),
    Column('advisor_name', String(length=128)),
    Column('title', String(length=128)),
    Column('description', String),
    Column('date', DateTime),
)


def upgrade(migrate_engine):
    # Upgrade operations go here. Don't create your own engine; bind
    # migrate_engine to your metadata
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    pre_meta.tables['migration_tmp'].drop()
    post_meta.tables['form'].create()


def downgrade(migrate_engine):
    # Operations to reverse the above upgrade go here.
    pre_meta.bind = migrate_engine
    post_meta.bind = migrate_engine
    pre_meta.tables['migration_tmp'].create()
    post_meta.tables['form'].drop()
