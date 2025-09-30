# Create -> Read -> Update -> Delete

1. [ ] Reading from the database
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
        - phpmyadmin
        - [ ] Go to `Docker Desktop`
        - [ ] Click Play button near the `phpmyadmin`
        - [ ] Port will turn blue click it
    - [ ] Check if it contains data
- [ ] Create `test\user.php` for view
    - [ ] Add table here depends on your columns
- [ ] Create `Controller` named `ReadTest`
    - [ ] Create function and below it wire up the fetching of data
        - [ ] Add Try Catch
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
            $listOfUser = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
            ```
            - [ ] Fetch the Data from DB using the model
            ```php
            $listOfUser = $model->where('is_active', 1)->where('is_available', 1)->orderBy('id', 'ASC')->findAll();
            <!-- My code SQL or ORM Commands state to feth only the is_active that is true, is_available that is true, sort(orderBy) id in ascending and i need all -->
            ```
            - [ ] Then send it to the frontend. its bit different from usual view. this is how we use to connect backend that fetches data to frontend, aside from this demo we can add more than 1
            ```php
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
                                <?php
                                $id = $it->id ?? null;
                                $title = $it->title ?? '';
                                $cost = $it->cost ?? 0;
                                $is_available = $it->is_available ?? 0;
                                ?>
                                <td class="p-3"><?php echo $id; ?></td>
                                <td class="p-3"><?php echo $title; ?></td>
                                <td class="p-3">₱<?php echo number_format((float) $cost, 2); ?></td>
                                <td class="p-3"><?php echo ((int) $is_available === 1) ? 'Yes' : 'No'; ?></td>
                                <td class="flex gap-2 p-3">
                                    <div class="flex justify-end mb-4">
                                        <a class="bg-gray-600/70 hover:bg-gray-600/60 px-3 py-2 rounded text-white duration-200 cursor-pointer" href="<?php echo site_url('services/' . urlencode($id)); ?>">
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

2. [ ] Creating to the database
- Check Module 2
    - `Sign Up`
- [ ] Redo it by Creating `test\user_create.php` for view
- [ ] Add new function under the `Controller` named `CreateTest`
- [ ] Connect in route

3. [ ] Update using `Patch`
- [ ] Create `test\user_update.php` for view
    - [ ] Add inputs here depends on your columns
    - [ ] Dont add the password
- [ ] Add new function under the `Controller` named `UpdatePatchTest`
    - [ ] 
- [ ] Connect in route

4. [ ] Update using `Put`
- Create `test\user_password_update.php` for view
    - [ ] Add inputs of password, new password and confirmation password
- 

4. [ ] Soft Delete