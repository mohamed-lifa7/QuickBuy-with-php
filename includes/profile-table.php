<div class="my-info container">
    <h2>My Info</h2>
    <form action="edit-profile.php" method="post" enctype="multipart/form-data" class="form-profile">
        <div class="info">
            <div class="photo-profile">
                <img src="<?php echo $user['photo'] ?>" alt="Profile Photo" class="profile-photo">
                <label class="edit-field">
                    <p>Select Photo Profile</p>
                    <i class="fa fa-2x fa-camera camera"></i>
                    <input type="file" class="edit-image" value="<?php echo $user['photo']; ?>" name="image">
                </label>
            </div>
            <table class="user-info-table">
                <tr>
                    <td class="field">Name</td>
                    <td class="value">
                        <span class="plain-text">
                            <?php echo $user['name']; ?>
                        </span>
                        <input type="text" class="edit-field" value="<?php echo $user['name']; ?>" name="name" required>
                        <i class="fas fa-user-edit edit-field"></i>
                    </td>
                </tr>
                <tr>
                    <td class="field">User-name</td>
                    <td class="value">
                        <span class="plain-text">
                            <?php echo $user['user_name']; ?>
                        </span>
                        <input type="text" class="edit-field" value="<?php echo $user['user_name']; ?>" name="user_name"
                            required>
                        <i class="fas fa-user-edit edit-field"></i>
                    </td>
                </tr>
                <tr>
                    <td class="field">Email</td>
                    <td class="value">
                        <span class="plain-text">
                            <?php echo $user['email']; ?>
                        </span>
                        <input type="email" class="edit-field" value="<?php echo $user['email']; ?>" name="email"
                            required>
                        <i class="fas fa-user-edit edit-field"></i>
                    </td>
                </tr>
                <tr>
                    <td class="field">Member Since</td>
                    <td class="value">
                        <?php echo $user['created_at']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="field">Role</td>
                    <td class="value">
                        <?php echo $_SESSION['user_type']; ?>
                    </td>
                </tr>
                <tr>
                    <td class="field">Status</td>
                    <?php
                    echo '<td class="value">';
                    if ($user['status'] == 1) {
                        echo 'Open';
                    } else if ($user['status'] == 0) {
                        echo 'Pending';
                    } else {
                        echo 'Blocked';
                    }
                    echo '</td>'
                        ?>
                </tr>

            </table>
            <div class="edit-buttons">
                <button class="edit-btn" type="button"><i class="fas fa-edit"></i></button>
                <input type="hidden" value="<?php echo $user['user_id']; ?>" name="user_id" required readonly>
                <button class="save-btn" name="save" type="submit">Save</button>
                <button class="cancel-btn" type="button">Cancel</button>
            </div>
        </div>
    </form>
    <script>
        // Get the edit button and the save/cancel buttons
        const editBtn = document.querySelector('.edit-btn');
        const saveBtn = document.querySelector('.save-btn');
        const cancelBtn = document.querySelector('.cancel-btn');

        // Get the plain text and input fields
        const plainTexts = document.querySelectorAll('.plain-text');
        const inputFields = document.querySelectorAll('.edit-field');

        // Hide the input fields and save/cancel buttons initially
        inputFields.forEach(input => {
            input.style.display = 'none';
        });
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';

        // Add a click event listener to the edit button
        editBtn.addEventListener('click', () => {
            // Hide the plain text and show the input fields
            plainTexts.forEach(text => {
                text.style.display = 'none';
            });
            inputFields.forEach(input => {
                input.style.display = 'block';
            });

            // Show the save/cancel buttons and hide the edit button
            saveBtn.style.display = 'inline-block';
            cancelBtn.style.display = 'inline-block';
            editBtn.style.display = 'none';
            inputFields[1].focus();
        });

        // Add a click event listener to the cancel button
        cancelBtn.addEventListener('click', () => {
            // Hide the input fields and save/cancel buttons and show the plain text
            inputFields.forEach(input => {
                input.style.display = 'none';
            });
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            plainTexts.forEach(text => {
                text.style.display = 'inline-block';
            });

            // Show the edit button
            editBtn.style.display = 'inline-block';
        });

        // Add a click event listener to the save button
        saveBtn.addEventListener('click', () => {
            // Hide the input fields and save/cancel buttons and show the plain text
            inputFields.forEach(input => {
                input.style.display = 'none';
                input.previousElementSibling.innerText = input.value;
            });
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            plainTexts.forEach(text => {
                text.style.display = 'inline-block';
            });

            // Show the edit button
            editBtn.style.display = 'inline-block';

            // Submit the form
            document.querySelector('.form-profile').submit();
        });
    </script>
</div>

<!-- ======================================================= -->