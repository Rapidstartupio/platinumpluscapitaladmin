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

</style>
<div class="container">
        <table class="table table-hover text-center">
            <caption>
                <p class="h3 text-center">Recent Transactions</p>
            </caption>
            <thead class="text-center">
            <tr>
                <th scope="col" class="px-6 py-4 text-center">
                    Transaction ID
                </th>
                <th scope="col" class="px-6 py-4 text-center">
                    Amount
                </th>
                <th scope="col" class="px-6 py-4 text-center">
                    Balance Type
                </th>
                <th scope="col" class="px-6 py-4 text-center">
                    Transaction Type
                </th>
                <th scope="col" class="px-6 py-4 text-center">
                    Date Created
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr class="">
                        <td class=" text-center">
                            #{{$transaction->transaction_id}}
                        </td>
                        <td class="px-6 py-5">
                            ${{$transaction->amount}}
                        </td>
                        <td class="px-6 py-5">
                            {{$transaction->balance_type}}
                        </td>
                        <td class="px-6 py-5">
                            {{$transaction->type}}
                        </td>
                        <td class="px-6 py-5">
                            {{$transaction->created_at}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
