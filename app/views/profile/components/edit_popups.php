<!-- Profile Name Edit Modal -->
<div class="modal fade" id="editProfileNameModal" tabindex="-1"
    aria-labelledby="editProfileNameModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold" id="editProfileNameModalLabel">
                        <i class="fa-solid fa-user-pen text-info me-2"></i>
                        Edit Profile Name
                    </h1>

                    <p class="text-muted">
                        Update your profile name
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form action="<?= route('/profile/editName') ?>" method="POST">

                <div class="modal-body pt-4">

                    <div class="mb-3">

                        <label for="name"
                            class="form-label fw-semibold">
                            Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-user text-info"></i>
                            </span>

                            <input type="text"
                                id="name"
                                name="name"
                                class="form-control border-start-0"
                                value="<?= auth('name') ?>"
                                placeholder="Enter your name">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-check me-1"></i>
                        Save Changes

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Profile Email Edit Modal -->
<div class="modal fade" id="editProfileEmailModal" tabindex="-1"
    aria-labelledby="editProfileEmailModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold"
                        id="editProfileEmailModalLabel">

                        <i class="fa-solid fa-envelope text-info me-2"></i>
                        Edit Profile Email

                    </h1>

                    <p class="text-muted">
                        Update your email address
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form action="<?= route('/profile/editEmail') ?>" method="POST">

                <div class="modal-body pt-4">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-envelope text-info"></i>
                            </span>

                            <input type="email"
                                name="email"
                                class="form-control border-start-0"
                                value="<?= auth('email') ?>"
                                placeholder="Enter your email">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-check me-1"></i>
                        Save Changes

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Profile Gender Edit Modal -->
<div class="modal fade" id="editProfileGenderModal" tabindex="-1"
    aria-labelledby="editProfileGenderModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold"
                        id="editProfileGenderModalLabel">

                        <i class="fa-solid fa-venus-mars text-info me-2"></i>
                        Edit Profile Gender

                    </h1>

                    <p class="text-muted">
                        Update your gender
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form action="<?= route('/profile/editGender') ?>" method="POST">

                <div class="modal-body pt-4">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Gender
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-venus-mars text-info"></i>
                            </span>

                            <select name="gender"
                                class="form-select border-start-0">

                                <option value="" disabled>
                                    Select your gender
                                </option>

                                <option value="Male"
                                    <?= auth('gender') === 'Male' ? 'selected' : '' ?>>
                                    Male
                                </option>

                                <option value="Female"
                                    <?= auth('gender') === 'Female' ? 'selected' : '' ?>>
                                    Female
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-check me-1"></i>
                        Save Changes

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Profile Phone Edit Modal -->
<div class="modal fade" id="editProfilePhoneModal" tabindex="-1"
    aria-labelledby="editProfilePhoneModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold"
                        id="editProfilePhoneModalLabel">

                        <i class="fa-solid fa-phone text-info me-2"></i>
                        Edit Profile Phone

                    </h1>

                    <p class="text-muted">
                        Update your phone number
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form action="<?= route('/profile/editPhone') ?>" method="POST">

                <div class="modal-body pt-4">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Phone
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-phone text-info"></i>
                            </span>

                            <input type="text"
                                name="phone"
                                class="form-control border-start-0"
                                value="<?= auth('phone') ?>"
                                placeholder="Enter your phone number">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-check me-1"></i>
                        Save Changes

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Profile Password Edit Modal -->
<div class="modal fade" id="editProfilePasswordModal" tabindex="-1"
    aria-labelledby="editProfilePasswordModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold"
                        id="editProfilePasswordModalLabel">

                        <i class="fa-solid fa-lock text-info me-2"></i>
                        Edit Profile Password

                    </h1>

                    <p class="text-muted">
                        Update your account password
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form action="<?= route('/profile/editPassword') ?>" method="POST">

                <div class="modal-body pt-4">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            New Password
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-lock text-info"></i>
                            </span>

                            <input type="password"
                                name="password"
                                class="form-control border-start-0"
                                placeholder="Enter your new password">

                        </div>

                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-check me-1"></i>
                        Save Changes

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

<!-- Add Author Modal -->
<div class="modal fade" id="addAuthorModal" tabindex="-1"
    aria-labelledby="addAuthorModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">

            <!-- Header -->
            <div class="modal-header border-0 pb-0">

                <div>
                    <h1 class="modal-title fs-5 fw-bold"
                        id="addAuthorModalLabel">

                        <i class="fa-solid fa-user-plus text-info me-2"></i>
                        Add Author

                    </h1>

                    <p class="text-muted mb-0">
                        Enter the details of the new author
                    </p>
                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <!-- Form -->
            <form id="AddAuthorForm">

                <div class="modal-body pt-4">

                    <!-- Author Name -->
                    <div class="mb-3">

                        <label for="authorName"
                            class="form-label fw-semibold">

                            Author Name

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-user text-info"></i>
                            </span>

                            <input type="text"
                                id="authorName"
                                name="name"
                                class="form-control border-start-0"
                                placeholder="Enter the author's name">


                        </div>

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="name">
                        </p>
                    </div>


                    <!-- Author Bio -->
                    <div class="mb-3">

                        <label for="authorBio"
                            class="form-label fw-semibold">

                            Author Bio

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                                <i class="fa-solid fa-align-left text-info"></i>
                            </span>

                            <textarea
                                id="authorBio"
                                name="bio"
                                rows="4"
                                class="form-control border-start-0"
                                placeholder="Write a short bio about the author..."></textarea>

                        </div>

                        <p class="alert alert-danger mt-2 d-none"
                            data-error-name="bio">
                        </p>

                        <div class="form-text">
                            Add a short description about the author.
                        </div>

                    </div>

                </div>


                <!-- Footer -->
                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-user-plus me-1"></i>
                        Add Author

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- Add Book Modal -->
<div class="modal fade"
    id="addBookModal"
    tabindex="-1"
    aria-labelledby="addBookModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow border-0">

            <!-- Header -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h1 class="modal-title fs-5 fw-bold"
                        id="addBookModalLabel">

                        <i class="fa-solid fa-book text-info me-2"></i>
                        Add Book

                    </h1>

                    <p class="text-muted mb-0">
                        Enter the details of the new book
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            <!-- Form -->
            <form id="AddBookForm">

                <div class="modal-body pt-4">


                    <!-- Author -->
                    <div class="mb-3">

                        <label for="AuthorName"
                            class="form-label fw-semibold">

                            Author Name

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-user text-info"></i>
                            </span>

                            <input type="text"
                                id="AuthorName"
                                class="form-control border-start-0"
                                placeholder="Author name"
                                readonly>

                        </div>

                        <!-- Author ID -->
                        <input type="hidden"
                            id="AuthorId"
                            name="bookAuthorId">

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="bookAuthorId">
                        </p>

                    </div>


                    <!-- Book Title -->
                    <div class="mb-3">

                        <label for="BookTitle"
                            class="form-label fw-semibold">

                            Book Title

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-book text-info"></i>
                            </span>

                            <input type="text"
                                id="BookTitle"
                                name="bookTitle"
                                class="form-control border-start-0"
                                placeholder="Enter the book's title">

                        </div>

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="bookTitle">
                        </p>

                    </div>


                    <!-- Book Image -->
                    <div class="mb-3">

                        <label for="BookImage"
                            class="form-label fw-semibold">

                            Book Image

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-image text-info"></i>
                            </span>

                            <input type="file"
                                id="BookImage"
                                name="bookImage"
                                class="form-control border-start-0"
                                accept=".jpg,.jpeg,.png">

                        </div>

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="bookImage">
                        </p>

                    </div>


                    <!-- Book Description -->
                    <div class="mb-3">

                        <label for="BookDescription"
                            class="form-label fw-semibold">

                            Book Description

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0 align-items-start pt-3">
                                <i class="fa-solid fa-align-left text-info"></i>
                            </span>

                            <textarea
                                id="BookDescription"
                                name="bookDescription"
                                rows="4"
                                class="form-control border-start-0"
                                placeholder="Write a short description about the book..."></textarea>

                        </div>

                        <p class="alert alert-danger mt-2 d-none"
                            data-error-name="bookDescription">
                        </p>

                        <div class="form-text">
                            Add a short description about the book.
                        </div>

                    </div>


                    <!-- Book Price -->
                    <div class="mb-3">

                        <label for="BookPrice"
                            class="form-label fw-semibold">

                            Book Price

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-money-bill text-info"></i>
                            </span>

                            <input type="number"
                                id="BookPrice"
                                name="bookPrice"
                                class="form-control border-start-0"
                                placeholder="Enter the book's price"
                                min="0"
                                step="0.01">

                        </div>

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="bookPrice">
                        </p>

                    </div>


                    <!-- Book Stock -->
                    <div class="mb-3">

                        <label for="BookStock"
                            class="form-label fw-semibold">

                            Book Stock

                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-boxes-stacked text-info"></i>
                            </span>

                            <input type="number"
                                id="BookStock"
                                name="bookStock"
                                class="form-control border-start-0"
                                placeholder="Enter the book's stock"
                                min="0">

                        </div>

                        <p class="alert alert-danger mt-3 d-none"
                            data-error-name="bookStock">
                        </p>

                    </div>

                </div>


                <!-- Footer -->
                <div class="modal-footer border-0 pt-0">

                    <button type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                        class="btn btn-info text-white px-4">

                        <i class="fa-solid fa-plus me-1"></i>
                        Add Book

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Cart Modal -->
<div class="modal fade"
    id="CartModal"
    tabindex="-1"
    aria-labelledby="CartModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content shadow border-0">

            <!-- Header -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h1 class="modal-title fs-5 fw-bold"
                        id="CartModalLabel">

                        <i class="fa-solid fa-book text-info me-2"></i>
                        Add Book

                    </h1>

                    <p class="text-muted mb-0">
                        Enter the details of the new book
                    </p>

                </div>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body pt-4">
                

            </div>

            <div class="modal-footer border-0 pt-0">

                <button type="button"
                    class="btn btn-light border"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="submit"
                    class="btn btn-info text-white px-4">

                    <i class="fa-solid fa-plus me-1"></i>
                    Add Book

                </button>

            </div>

        </div>

    </div>

</div>