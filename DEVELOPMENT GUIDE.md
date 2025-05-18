## __DEVELOPMENT GUIDE__

### _Running Tailwind Production_
- Use tailwind production not css
- npm install first before running the following script for development
    - '__npm run dev__' cli prompt without quotes

### _Linking CSS, JS, and FontAwesome in Pages_
- CSS path: &nbsp; __./assets/css/output.css__
- JS path: &nbsp; __./assets/js/jquery-3.7.1.min.js__
- FontAwesome paths: 
    - __./assets/css/fontawesome/all.min.css__
    - __./assets/css/fontawesome/fontawesome.min.css__

### _Always make another branch for each feature to develop_
- Make a pull request if branch is already done
    - Notify a reviewer to review and merge your code
    - Always use __squash merge__ if merging a request to main

### _Always check for the updated main_
- This is to avoid conflicts
- Run __git pull origin main__ to update main if new commits are made to it

### _DB Credentials_
- connect_db.php connects the site to the db
- __.env__ contains the credentials for it