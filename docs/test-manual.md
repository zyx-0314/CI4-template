# Manual testing

## Authentication Account: http://localhost:8090/login
### Wrong Email
- Email: wrong.martin.manager@example.test
- Password: Password123!
- Result: Must Show Error indicator in Email Input
### Wrong Password
- Email: martin.manager@example.test
- Password: WrongPassword123!
- Result: Must Show Error indicator in Password Input
### Inactive/Deleted Account
- Email: bob@example.test
- Password: Password123!
- Result: Must Show Error indicator in Email Input
### Correct Login
#### Manager
- Email: martin.manager@example.test
- Password: Password123!
- Result: Redirect to Manager Dashboard: http://localhost:8090/admin/dashboard
#### Employee
- Email: ethan.embalmer@example.test
- Password: Password123!
- Result: Redirect to Employee Dashboard: http://localhost:8090/employee/dashboard
#### Client
- Email: alice@example.test
- Password: Password123!
- Result: Redirect to Landing Page with logged header: http://localhost:8090/

### Sign Up - Client: http://localhost:8090/signup
- **Required:** Min 2 character in First Name, Last Name
- **Password** and **Confirmation Password** match

---

## Services
### Read Services
- Available and Not(Manager): http://localhost:8090/admin/services
    - Sort: Cost and Name
    - Filter: Available
    - Search: Title
- Available: http://localhost:8090/services
    - Sort: Cost and Name
    - Search: Title
- Specific: http://localhost:8090/services/1

### Create Service
- http://localhost:8090/admin/services > Create Service button

### Delete Service
- http://localhost:8090/admin/services > Delete Icon button

### Update Service
- http://localhost:8090/admin/services > Update Icon button

---

## Accounts
### Read Accounts
- Summarized Table: http://localhost:8090/admin/accounts
    - Sort: Type
    - Sort: Name and Email
    - Search: Name and Email

### Create Account
- Client: http://localhost:8090/signup
- Employee: http://localhost:8090/admin/accounts > Create Account Button

### Delete Account
- http://localhost:8090/admin/accounts > Delete Icon Button

### Update Account
- http://localhost:8090/admin/accounts > Update Icon Button

---

## Inquiries
### Read Inquiries
- All inqueries: http://localhost:8090/admin/inquiries
    - Sort: Start Date and End Date
    - Filter: Status
    - Search: Name and Service

### Create Inquries
Format: http://localhost:8090/reservation/<id>
sample using 4
- http://localhost:8090/reservation/4

### Update Inquries
- http://localhost:8090/admin/inquiries > Update Icon Button
