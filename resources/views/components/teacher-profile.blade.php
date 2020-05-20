<div class="item-group">
    <label for="empno">Employee Number:</label>
    <input type="text" name="empno" value="{{ $teacher->empno }}" class="input" disabled>
</div>

<div class="item-group">
    <label for="cabinno">Cabin Number:</label>
    <input type="text" name="cabinno" value="{{ $teacher->cabinno }}" class="input">
</div>

<div class="item-group">
    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" value="{{ $teacher->phone }}" class="input" maxlength="10">
</div>