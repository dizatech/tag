<div class="row">
    <div class="col-md-12">
        <div class="form-group has-primary">
            <label for="{{ $name }}">
                <strong>{{ $label }}</strong>
            </label>
            <select name="{{ $name }}[]" id="{{ $name }}" class="form-control select2_search_tags" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

