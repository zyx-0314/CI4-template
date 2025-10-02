# View -> Controller -> Routes

[ ] 1. Setup Environment
- [ ] Create project from template
- [ ] Clone to your local
- [ ] Make sure `Docker`, `php`(optional) and `composer`(optional) is installed to you pc. Your goof even you only using `Docker` but if youre orrotated in red lines install all
- [ ] (optional) If you have `php` and `composer` do this. After clone inside the `backend` folder use command
```bash
composer install
```
- [ ] Start with updating `readme`
- [ ] Once all done you can start adding your `label` in your source control.
    - [ ] Since we updated the `readme`. since `readme` is document then we will automatically use `docs`
```bash
docs(readme): Updated the `readme`
```
- [ ] Start pushing directly to `main` or from a `branch` in `stagging`. Possible branch name `docs/readme`
- [ ] Once satisfied a `publish` or `sync` click it to push from `stagged` to the `remote`
- [ ] Create `Branch` name it `development` so you can safely develop without triggering auto checker

---

[ ] 2. Create your personal landing page
- [ ] Create `Issue` named Landing Page, can add description if you want to.
- [ ] Create `Branch` name it `frontend/landingPage`. make sure that you are in right branch looking at the bottom left you should see `frontend/landingPage` not `main`, `development`
- [ ] Add new `View` with basics html requirements under the `user` folder with name `landing.php`
- [ ] Add new `Controller` named `Users` using command found on templates(requires php and composer) readme or coding your own
```php
// Template Controller
<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NameOfControllerHere extends BaseController
{
    public function index(): string
    {
        // code here
    }
}
```
- [ ] Sample Coding in Controller
    - [ ] Change the `NameOfControllerHere` with the name of controller
    - [ ] Add `return view('user/landing');` inside `index()` to show the page
        - [ ] You can add more functions for different display or `routes`/`end point`
		```php
		// End point
		// Format: $routes-><request type>('end point name`, 'Controller Name::Controller Function')
		$routes->get('/', 'Users::index');
		```
- [ ] Update `Routes.php` under `Config`
    - [ ] Update `Home::index` to `Users::index` reflecting the `User` Controller and `index` as one of its function
- [ ] Now visit your site for manual checking.
    - Open Docker Desktop
    - Check Port from `nginx` it should by default `8090` but can use other poerts
    - This is the default port [live](http://localhost:8090/).
    - This wont pose issue if you didnt change the port or the port is not in use
- [ ] Once all working you can start adding your `label` in your source control.
    - [ ] Since we created landing page view, controller and updated the routes. We could say we added a new feature
```bash
feat(landing page): Added a new landing page

- added new `view`
- added new `controller`
- updated routes to route the landing page
- deleted unecessary files
```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
- [ ] Once in `remote` you can create `PR` or `Pull Request`.
    - [ ] Make sure `PR` is from your completed branch which this time is `frontend/landingPage` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

---

[ ] 3. Create your Login Page
- [ ] Create `Issue` named Login Page, can add description if you want to.
- [ ] Create `Branch` name it `frontend/loginPage`. make sure that you are in right branch looking at the bottom left you should see `frontend/loginPage` not `main`, `frontend/landingPage`, `development`
- [ ] Add new `View` with basics html requirements under the `user` folder with name `loginPage.php`
- [ ] Update new `Controller` named `Users` using command found on templates(requires php and composer) readme or coding your own
```php
// Template Controller
<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NameOfControllerHere extends BaseController
{
    public function index(): string
    {
        // code here
    }

    public function loginPage(): string
    {
        // code here
    }
}
```
- [ ] Sample Coding in Controller
    - [ ] Add `return view('user/loginPage');` inside `loginPage()` to show the page
        - [ ] You can add more functions for different display or `routes`/`end point`
		```php
		// End point
		// Format: $routes-><request type>('end point name`, 'Controller Name::Controller Function')
		$routes->get('/', 'Users::index');
		$routes->get('/login', 'Users::loginPage');
		```
- [ ] Update `Routes.php` under `Config`
	- [ ] Add new Route for using `get` login: `$routes->get('/login', '');`
	- [ ] Add the controller to the route: `$routes->get('/login', 'Users::loginPage');` comming from controller `Users` use the function `loginPage`
- [ ] Now visit your site for manual checking
    - Open Docker Desktop
    - Check Port from `nginx` it should by default `8090` but can use other poerts
    - This is the default port [live](http://localhost:8090/login).
    - This wont pose issue if you didnt change the port or the port is not in use
- [ ] Once all working you can start adding your `label` in your source control.
    - [ ] Since we created login page view, controller and updated the routes. We could say we added a new feature
```bash
feat(login page): Added a new login page

- added new `view`
- update new `controller`
- updated routes to route the login page
```
- [ ] Start `pushing` directly to the `branch` in `stagged`. If any changes is needed then add another `push`.
- [ ] Once satisfied a `publish` or `sync`, click it to push from `stagged` to the `remote`
- [ ] Once in `remote` you can create `PR` or `Pull Request`.
    - [ ] Make sure `PR` is from your completed branch which this time is `frontend/loginPage` and going to `development`
- [ ] Once `PR` is created if there is other member who need to review it you can set them to review and click `merge` if all goods, else you can comment and provide feedback.

---

[ ] 4. Activity
Create the following, with their own issues, branches and PR
- [ ] Create Sign Up Page
- [ ] Create Mood Board Page. It must contain the following
    - [ ] Color palette: min of 3
    - [ ] Typography: 2 fonts
    - [ ] Buttons set: Primary, secondary, borderm, disabled
    - [ ] Card set: Card Sample
    - [ ] Logos: Circle and Square format
- [ ] Create Road Map Page
    - [ ] List of Functionalities
> Keep in mind to follow the Step 2 to familiarize

---

[ ] 5. Fragmentation
Fragment the following
- [ ] Header
- [ ] Footer
- [ ] The 3 Cards
- [ ] CTA Section
- [ ] The 4 Buttons

---

[ ] 6. Complete Project
- [ ] Propose 3 Functionality with CRUD add to the road map

---

[ ] 7. Wrapping up
- [ ] Test your development branch
- [ ] Make PR to `main`/`master` branch then `merge`