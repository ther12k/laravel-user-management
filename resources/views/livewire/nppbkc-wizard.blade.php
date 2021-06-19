<div class="container">
   
    @if(!empty($successMessage))
    <div class="alert alert-success">
       {{ $successMessage }}
    </div>
    @endif
      
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">3</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-4" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">4</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-5" type="button" class="btn btn-circle {{ $currentStep != 5 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">5</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-6" type="button" class="btn btn-circle {{ $currentStep != 6 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">6</a>
                
            </div>
            <div class="stepwizard-step">
                <a href="#step-7" type="button" class="btn btn-circle {{ $currentStep != 7 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">7</a>
                
            </div>
        </div>
    </div>
    
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        <div class="col-md-12 col-xs-12">
            <div class="col-md-6">
                <h4> Data Pemilik</h4>

                <div class="form-group">
                    <label for="title">Status Pemohon :</label>
                    <select id="status_pemohon" class="form-control" wire:model="status_pemohon">
                        <option value="sendiri" >Sendiri</option>
                        <option value="dikuasakan" >Dikuasakan</option>
                    </select>
                    @error('status_pemohon') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="nama_pemilik">Nama Pemilik :</label>
                    <input type="text" wire:model="nama_pemilik" class="form-control"/>
                    @error('nama_pemilik') <span class="text-danger error">{{ $message }}</span> @enderror
                </div>    
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="alamat_pemilik">Alamat Pemilik :</label>
                    <textarea type="text" wire:model="alamat_pemilik" class="form-control">{{{ $alamat_pemilik ?? '' }}}</textarea>
                    @error('alamat_pemilik') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="npwp_pemilik">NPWP Pemilik :</label>
                    <input type="text" wire:model="npwp_pemilik" class="form-control"/>
                    @error('npwp_pemilik') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="telp_pemilik">No Telp Pemilik :</label>
                    <input type="text" wire:model="telp_pemilik" class="form-control"/>
                    @error('telp_pemilik') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="email_pemilik">Email Pemilik :</label>
                    <input type="text" wire:model="email_pemilik" class="form-control"/>
                    @error('email_pemilik') <span class="error">{{ $message }}</span> @enderror
                </div>
    
                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button" >Next</button>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 2</h3>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>
            </div>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 3</h3>
    
                <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(2)">Back</button>
            </div>
        </div>
    </div>
</div>