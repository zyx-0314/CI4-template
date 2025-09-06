# Test Manual

## Auth

This chapter lists the authentication-related functions and short manual test steps for each.

### Login — client account

Purpose
- Verify that a client can log in and is redirected to their profile page.

Sample payload

```json
{
	"email": "alice@example.test",
	"password": "Password123!"
}
```

Manual steps
1. Ensure Docker containers are up and migrations/seeds applied (see repo README).

### Login — manager (admin) account

Purpose
- Verify that a manager-level user logs in and is redirected to the admin dashboard.

Sample payload

```json
{
	"email": "martin.manager@example.test",
	"password": "Password123!"
}
```

Manual steps
1. Ensure Docker containers are up and migrations/seeds applied (see repo README).

### Login — employee account

Purpose
- Verify that a non-client, non-manager user (employee) logs in and is redirected to the employee dashboard.

Sample payload

```json
{
	"email": "ethan.embalmer@example.test",
	"password": "Password123!"
}
```

Manual steps
1. Ensure Docker containers are up and migrations/seeds applied (see repo README).


### Logout

Purpose
- Verify logout clears the session and redirects to the home page.

Manual steps
1. Log in as any user.
2. Visit `/logout`.
3. Expect redirect to `/` and no `user` data in session.

---
