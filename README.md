#Jira Dasbhoard
#Getting Started
To correctly set up this dashboard make sure to config the .env file

JIRA_HOST=""
JIRA_USER=""
JIRA_PASS=""

Create .env in Database folder which will contain:

DB_HOST=''
DB_NAME=''
DB_USER=''
DB_PASS=''

Since JIRA_PASS as usual password was deprecated, you have to generate your own JIRA TOKEN and paste it there.

If you're connected to JIRA Cloud Platform make sure to enable option:

JIRA_REST_API_V3=true

## CHANGELOG ##

v1.0 - initial release - 22.08.2019 
