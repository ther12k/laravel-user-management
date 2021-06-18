<div>    
    <input type="text"  class="form-control" placeholder="Search" wire:model="search" />                
    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pemilik</th>
                <th>Lokasi</th>
                <th>No. Pemohonan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>  
            @foreach($nppbkcs as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->nama_pemilik}}</td>
                <td>{{$row->lokasi}}</td>
                <td>{{$row->id}}</td>
                <td>{{$row->status_nppbkc}}</td>
            </tr>
            @endforeach 
        </tbody>            
    </table>  
        {{ $nppbkcs->links() }}     
</div>