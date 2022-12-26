<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="comment">{{ __('Comment') }}</label>
            <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror" placeholder="{{ __('Comment') }}" required>{{ isset($comment) ? $comment->comment : old('comment') }}</textarea>
            @error('comment')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="user-id">{{ __('User') }}</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($comment) && $comment->user_id == $user->id ? 'selected' : (old('user_id') == $user->id ? 'selected' : '') }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="rate-id">{{ __('Rate') }}</label>
            <select class="form-select @error('rate_id') is-invalid @enderror" name="rate_id" id="rate-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select rate') }} --</option>
                
                        @foreach ($rates as $rate)
                            <option value="{{ $rate->id }}" {{ isset($comment) && $comment->rate_id == $rate->id ? 'selected' : (old('rate_id') == $rate->id ? 'selected' : '') }}>
                                {{ $rate->user_id }}
                            </option>
                        @endforeach
            </select>
            @error('rate_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>