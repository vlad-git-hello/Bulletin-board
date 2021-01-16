<form action="?" method="GET">
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="name" class="col-form-label">Title</label>
                <input id="name" class="form-control" name="name" value="">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <label for="user" class="col-form-label">User</label>
                <input id="user" class="form-control" name="user" value="">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <label for="region" class="col-form-label">Region</label>
                <input id="region" class="form-control" name="region" value="">
            </div>
        </div>
        <div class="col-sm-1">
            <div class="form-group">
                <label for="category" class="col-form-label">Category</label>
                <input id="category" class="form-control" name="category" value="">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select id="status" class="form-control" name="status">
                    <option value=""></option>
                    <option value=" $value "> $label</option>
                </select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label class="col-form-label">&nbsp;</label><br/>
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="?" class="btn btn-outline-secondary">Clear</a>
            </div>
        </div>
    </div>
</form>
