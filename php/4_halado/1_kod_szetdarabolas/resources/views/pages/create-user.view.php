<h1>Új felhasználó</h1>
<form action="<?= route('/user/save') ?>" method="post">
    <div class="form-group">
        <label for="first-name">Keresztnév:</label>
        <input type="text" id="first-name" name="first-name"
               class="form-control <?= isset($errors['first-name']) ? 'is-invalid' : '' ?>"
               value="<?= $old['first-name'] ?? '' ?>"
        >
        <?php if (isset($errors['first-name'])): ?>
            <div class="invalid-feedback">
                <?= $errors['first-name'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-2">
        <label for="last-name">Vezetéknév:</label>
        <input type="text" id="last-name" name="last-name"
               class="form-control <?= isset($errors['last-name']) ? 'is-invalid' : '' ?>"
               value="<?= $old['last-name'] ?? '' ?>"
        >
        <?php if (isset($errors['last-name'])): ?>
            <div class="invalid-feedback">
                <?= $errors['last-name'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-2">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email"
               class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
               value="<?= $old['email'] ?? '' ?>"
        >
        <?php if (isset($errors['email'])): ?>
            <div class="invalid-feedback">
                <?= $errors['email'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-2">
        <label for="gender">Nem:</label>
        <select id="gender" name="gender"
                class="form-control <?= isset($errors['gender']) ? 'is-invalid' : '' ?>"
        >
            <option value="Female" <?= ($old['gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Nő</option>
            <option value="Male" <?= ($old['gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Férfi</option>
        </select>
        <?php if (isset($errors['gender'])): ?>
            <div class="invalid-feedback">
                <?= $errors['gender'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-2">
        <label for="city">Város:</label>
        <input type="text" id="city" name="city"
               class="form-control <?= isset($errors['city']) ? 'is-invalid' : '' ?>"
               value="<?= $old['city'] ?? '' ?>"
        >
        <?php if (isset($errors['city'])): ?>
            <div class="invalid-feedback">
                <?= $errors['city'] ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-2">
        <label for="birthday">Születési dátum:</label>
        <input type="date" id="birthday" name="birthday"
               class="form-control <?= isset($errors['birthday']) ? 'is-invalid' : '' ?>"
               value="<?= $old['birthday'] ?? '' ?>"
        >
        <?php if (isset($errors['birthday'])): ?>
            <div class="invalid-feedback">
                <?= $errors['birthday'] ?>
            </div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Mentés</button>
</form>