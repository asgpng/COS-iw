# takes first argument as xls or csv file,
# then composes a list of users

import xlrd
import csv
import sys

def get_filetype(file_name):
    return file_name.split(".")[-1].strip().lower()

# for xls files as inputs
def parse_users_xlrd(file_name):

    wb = xlrd.open_workbook(file_name)
    sh = wb.sheet_by_index(0) # get first sheet

    # eventually use headers to check for legal inputs
    header1 = sh.cell(0,0).value # cell A1
    header2 = sh.cell(0,1).value # cell B1

    user_list = []

    for rownum in range(1,sh.nrows): # if first rows are headers
        user_list.append(sh.row_values(rownum))

    return user_list

# for csv files as inputs
def parse_users_csv(file_name):
    csvfile = open(file_name, 'rb')
    csv_reader = csv.reader(csvfile, delimiter=' ', quotechar='|')
    user_list = []
    row_num = 0            # hacked way of eliminating row headers
    for row in csv_reader:
        if row_num == 0:
            row_num = 1
            pass
        else:
            user_list.append(row[0].split(','))
    csvfile.close()
    return user_list

def main():

    file_name = sys.argv[1]
    if get_filetype(file_name) == 'xls':
        user_list = parse_users_xlrd(file_name)
    elif get_filetype(file_name) == 'csv':
        user_list = parse_users_csv(file_name)
    for user in user_list:
        print user[0], user[1]

if __name__=='__main__':
    main()
