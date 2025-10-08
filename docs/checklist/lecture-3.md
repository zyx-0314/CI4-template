# Read -> Create -> Update -> Delete

[ ] 1. Reading from the database
- [ ] Since we have db controlls already, we use seeding to have data inside making sure that connection is established
    - [ ] Do Seeding
    - [ ] Run your `phpmyadmin` or `vs code: db extensions(DBCode)` or other DB tools
        - DBCode
        - [ ]`Add Connection Button` Click it
        - [ ] Select `MySQL`
        - [ ] Name it. Example: `ItoAyDatabaseKongMalupet`
        - [ ] Set it host as `localhost` and `3390` since that is our default port
        - [ ] For password you can check or change in `compose.yml` or use the default `app` for both `username` and `password`
        - [ ] In `Database` click the `refresh icon` then `app` should appear or the name of the database in `compose.yml`
        - [ ] Click `Save`
        - phpmyadmin A
        - [ ] Go to `Docker Desktop`
        - [ ] Click Play button near the `phpmyadmin`
        - [ ] Port will turn blue click it
        - phpmyadmin B
        - [ ] In cmd use this command `docker compose up phpmyadmin`
    - [ ] Check if it contains data
- [ ] Create `user.php` inside folder named `test` for view
    - [ ] Add table here depends on your columns
- [ ] Create `Controller` named `CRUDTesting`
    - [ ] Create function named `showUsersPage` and below it wire up the fetching of data
        - [ ] Encapsulate with Try Catch
        ```php
        try {

        } catch (\Exception $e) {

        }
        ```
        - [ ] Inside the catch make a feed back that there is issue
        ```php
        try {
        } catch (\Exception $e) {
            $listOfUser = "There is issue in DB";
        }
        ```
        - [ ] Inside the Try is your code which
            - [ ] Fetch the Data structure from model
            ```php
            $model = new App\Models\UsersModel;
            ```
            - [ ] Fetch the Data from DB using the model
            ```php
            $listOfUser = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
            <!-- My code SQL or Query Builder Commands state to feth only the is_active that is true, is_available that is true, sort(orderBy) id in ascending -->
            ```
            - [ ] Then send it to the frontend. its bit different from usual view. this is how we use to connect backend that fetches data to frontend, aside from this demo we can add more than 1
            ```php
            <!-- The `test/user` is the view file while the ['key' => `value`] is the way to transfer data -->
            return view('test/user', ['listOfUser' => $listOfUser]);
            ```
- [ ] Update the view
    - [ ] Add this as a error catcher at top before the table
        ```php
        <?php if (is_string($ListOfUser)): ?>
            <!-- HTML when $ListOfUser is a string -->
            <div class="alert alert-info">
                <?= esc($ListOfUser) ?>
            </div>
        <?php
            return;
        endif;
        ?>
        ```
    - [ ] Map it. look for comment in conversion
        ```php
        <!-- The sample code design is based on the users table data structure -->
            <table class="w-full min-w-[640px] text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Title</th>
                        <th class="p-3">Cost</th>
                        <th class="p-3">Available</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pageItems)) : ?>
                        <tr>
                            <td class="p-3" colspan="5">No services found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pageItems as $it): ?>
                            <tr class="border-t">
                            <!-- In this part is the conversion -->
                                <td class="p-3"><?php echo $it->id; ?></td>
                                <td class="p-3"><?php echo $it->title; ?></td>
                                <td class="p-3">₱<?php echo number_format((float) $it->cost, 2); ?></td>
                                <td class="p-3"><?php echo ((int) $it->is_available === 1) ? 'Yes' : 'No'; ?></td>
                                <td class="flex gap-2 p-3">
                                    <div class="flex justify-end mb-4">
                                        <a class="bg-gray-600/70 hover:bg-gray-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('services/' . urlencode($it->id)); ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                    <?= view('components/modal/services/delete', ['service' => $it]) ?>
                                    <?= view('components/modal/services/update', ['service' => $it]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        ```
- [ ] Connect in route

[ ] 2. Creating to the database
- Check Module 2
    - `Sign Up`
- [ ] Redo it by Creating `user_create.php` inside folder named `test` for view
- [ ] Add new function under the `Controller` named `CRUDTesting`
- [ ] Connect in route

[ ] 3. Update using `Post`
> why `post` ci4 is not capable yet in using `put`, `patch` and `delete`
- [ ] Create `user_update.php` inside folder named `test` for view
    - [ ] Add inputs here depends on your columns
- [ ] Add new function under the `Controller` named `CRUDTesting`
    - [ ] Set recieved value as variable
    ```php
        $request = service('request');
        $post = $request->getPost();
    ```
    - [ ] Add session for returning values in case errors might appear
    ```php
        $session = session();
    ```
    - [ ] Use the model
    ```php
        <!-- In this case we are using users table -->
        $userModel = new UsersModel();
    ```
    - [ ] Create rules for verification of inputs. If error appears in validation return the information of error using session
    ```php
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');
        $validation->setRule('type', 'User Type', 'required|min_length[1]');

        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }
    ```
    - [ ] Encapsulating it with try catch
        ```php
            try {

            } catch (\Exception $e) {

            }
        ```
        - [ ] Inside the catch make a feed back that there is issue
        ```php
        try {
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while updating account: ' . $e->getMessage()]);
        }
        ```
    - [ ] Using the Query Builder check the the id provided if it exist
    ```php
        $account = $userModel->where('id', $post['id'])->first();
    ```
    - [ ] If there is error then return with error
    ```php
        if (! $account) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['success' => false, 'message' => 'Account not found']);
        }
    ```
    - [ ] Prepare data to be inputed in Query Builder
    ```php
        $payload = [
            'id' => $post['id'],
            'type' => $post['type'],
        ];
    ```
    - [ ] Store in the database using query builder
    ```php
        $ok = $userModel->save($payload);
    ```
    - [ ] If there is error return with error
    ```php
        if ($ok === false) {
            throw new \Exception('Model update failed');
        }
    ```
    - [ ] If all is good then return with success
    ```php
        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON(['success' => true, 'message' => 'Account Type Updated', 'data' => ['id' => $post['id']]]);
    ```
- [ ] Connect in route

5. Soft Deletion to the database
> why `post` ci4 is not capable yet in using `put`, `patch` and `delete`
- [ ] Create `user_update.php` inside folder named `test` for view
    - [ ] Add inputs here depends on your columns
- [ ] Add new function under the `Controller` named `CRUDTesting`
    - [ ] Set recieved value as variable
    ```php
        $request = service('request');
        $post = $request->getPost();
    ```
    - [ ] Add session for returning values in case errors might appear
    ```php
        $session = session();
    ```
    - [ ] Use the model
    ```php
        <!-- In this case we are using users table -->
        $userModel = new UsersModel();
    ```
    - [ ] Create rules for verification of inputs. If error appears in validation return the information of error using session
    ```php
        $validation = \Config\Services::validation();
        $validation->setRule('id', 'ID', 'required|min_length[1]');

        if (! $validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }
    ```
    - [ ] Encapsulating it with try catch
        ```php
            try {

            } catch (\Exception $e) {

            }
        ```
        - [ ] Inside the catch make a feed back that there is issue
        ```php
        try {
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR)
                ->setJSON(['success' => false, 'message' => 'Server error while deleting account: ' . $e->getMessage()]);
        }
        ```
    - [ ] Using the Query Builder check the the id provided if it exist
    ```php
        $account = $userModel->where('id', $post['id'])->first();
    ```
    - [ ] If there is error then return with error
    ```php
        if (! $account) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)
                ->setJSON(['success' => false, 'message' => 'Account not found']);
        }
    ```
    - [ ] Prepare data to be inputed in Query Builder
    ```php
        $payload = [
            'id' => $post['id'],
            'account_status' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    ```
    - [ ] Store in the database using query builder
    ```php
        $ok = $userModel->save($payload);
    ```
    - [ ] If there is error return with error
    ```php
        if ($ok === false) {
            throw new \Exception('Model deletion failed');
        }
    ```
    - [ ] If all is good then return with success
    ```php
        return $this->response->setStatusCode(ResponseInterface::HTTP_OK)
            ->setJSON(['success' => true, 'message' => 'Account Deleted', 'data' => ['id' => $post['id']]]);
    ```