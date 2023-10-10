<style>
    tr {
        height: 50px;
    }
    th {
        color: #777786 !important;
        font-size: 17px;
        font-weight: bold !important;
        font-family: Inter,ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;
    }

    td {
        font-size: 15px;
        /*font-weight: bold;*/
        font-family: Inter,ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;
    }
    p.h3 {
        font-weight: bold;
    }
    .custom {
        border: 1px solid #e0e0e0;
        display: flex;
        flex-wrap: wrap;
    }

</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="row"><div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div id="dataTable_filter" class="dataTables_filter">
                                <form action="{{ url('admin/interest/transactions') }}">
                                    <div class="custom">
                                        <input style="width: 80%;margin-top: 7px;" type="search" class="form-control input-sm" placeholder="username" name="username" value="{{ @request()->username }}">
                                        <button type="submit" class="btn btn-sm btn-primary pull-right edit">
                                            Search
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    Username
                                </th>

                                <th scope="col" class="text-center">
                                    Forex Balance
                                </th>
                                <th scope="col" class="text-center">
                                    Crypto Balance
                                </th>
                                <th scope="col" class="text-center">
                                    Date Created
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($transactions as $transaction)
                           <tr class="">
                            <td class=" text-center">
                                {{$transaction->user->username}}
                            </td>

                            <td class="px-6 py-5">
                                ${{$transaction->forex_amount}}
                            </td>
                            <td class="px-6 py-5">
                                ${{$transaction->crypto_amount}}
                            </td>
                            <td class="px-6 py-5">
                                {{$transaction->created_at}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div>{{ $transactions->links('pagination::bootstrap-4') }}</div>
</div>
