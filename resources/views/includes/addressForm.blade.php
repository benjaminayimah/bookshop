<form method="post" action="{{ route('post.address') }}">
    @csrf
    <div class="form-row details-row">
        <div class="form-group col-md-6">
            <label for="name">Full name *</label>
            <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="Full name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email Address *</label>
            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Email Address">
        </div>
    </div>
    <div class="form-row details-row">
        <div class="form-group col-md-6">
            <label for="phone">Phone number *</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">+233</span>
                </div>
                <input type="number" class="form-control" value="{{ old('phone') }}" id="phone" name="phone" placeholder="Phone number">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="altnumber">Alternative number</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">+233</span>
                </div>
            <input type="number" class="form-control" value="{{ old('alternativePhone') }}" id="altnumber" name="alternativePhone" placeholder="Alternative number">
            </div>
        </div>
    </div>
    <div class="form-row details-row">
        <div class="form-group col-md-6">
            <label for="address">Address *</label>
            <input type="text" class="form-control" id="address" value="{{ old('address') }}" name="address" placeholder="Address eg. Street address">
        </div>
        <div class="form-group col-md-6">
            <label for="Apartment">Apartment</label>
            <input type="text" class="form-control" id="apartment" value="{{ old('apartment') }}" name="apartment" placeholder="Apartment, Suite, Unit etc">
        </div>
    </div>
    <div class="form-row details-row">
        <div class="form-group col-md-6">
            <label for="city">Town/City *</label>
            <input type="text" class="form-control" id="city" value="{{ old('city') }}" name="city" placeholder="Town/City">
        </div>
        <div class="form-group col-md-6">
            <label for="country">Country *</label>
            <input type="text" class="form-control" id="country" value="{{ old('country') }}" name="country" placeholder="Country">
        </div>
    </div>
    <div class="form-row details-row">
        <div class="form-group col-md-12">
            <label for="address">Additional information</label>
            <textarea type="text" class="form-control" rows="3" id="additional" name="additionalInfo" placeholder="Additional information about your order, eg. special notes or info for delivery.">{{ old('additionalInfo') }}</textarea>
        </div>
    </div>
    @guest()
    <div class="form-row details-row">
        <div class="form-group col-md-12">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" name="createAccount" id="createacct" type="checkbox">
                <label class="custom-control-label" for="createacct">
                    <span class="epp-blue">Create a user login account with the provided e-mail?</span>
                </label>
            </div>
        </div>
    </div>
    @endguest
    <div class="form-row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn no-border epp-dark-blue-bg next-btn">Submit form</button>
        </div>
    </div>
</form>