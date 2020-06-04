<form action="{{$action}}" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="username">Username</label>
        <div class="input-group">
            <input type="text" class="form-control" id="username" name="username"
                   placeholder="Username"
                   @if(isset($disableFields)) disabled @endif
                   value="{{$issue->username}}"
                   required>
            <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
        </div>
    </div>

    <div class="mb-3">
        <label for="email">Email <span class="text-muted"></span></label>
        <input type="email" class="form-control" id="email" name="email"
               placeholder="you@example.com"
               @if(isset($disableFields)) disabled @endif
               value="{{$issue->email}}"
               required>
        <div class="invalid-feedback">Please enter a valid email address.</div>
    </div>

    <div class="mb-3">
        <label for="comments">Comments</label>
        <textarea class="form-control"
                  @if(isset($disableFields)) disabled @endif
                  id="comments"
                  name="comments">@if(isset($issueCreated)){{$issue->comments}}@endif</textarea>
        <div class="invalid-feedback">Please enter task comment.</div>
    </div>

    @if(isset($issueCreated))
        <div class="mb-3">
            <label for="email">Status: <span class="text-muted"></span> </label>
            <select name="status">
                <option value="@if($issue->status>1) 2 @else 0 @endif"
                        @if ($issue->status%2 == 0) selected="selected" @endif>Uncompleted
                </option>
                <option value="@if($issue->status>1) 3 @else 1 @endif"
                        @if ($issue->status%2 == 1) selected="selected" @endif>Completed
                </option>
            </select>
        </div>
    @endif

    <button class="btn btn-primary" type="submit" name="submit_edit_issue" value="Submit">Update Issue
    </button>
</form>
