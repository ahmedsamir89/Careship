var app = new Vue({
    el: '#app',
    data: {
        placeholderMessage: 'Insert your amount',
        isWithdrawButtonFreezed: false,
        hasResult: false,
        hasErrors: false,
        notes: '',
        amount: '',
        errorType: '',
        errorDesc: '',
    },
    methods: {
        withdraw: function (event) {
            this.isWithdrawButtonFreezed = true;
            var vm = this;
            fetch("/api/withdraw?amount="+this.amount)
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if(data.status != 200) {
                        vm.hasErrors = true;
                        vm.hasResult = false;
                        vm.errorType = data.type;
                        vm.errorDesc = data.message;
                    } else {
                        vm.errorType = '';
                        vm.errorDesc = '';
                        vm.notes = "[" + data.result.join(', ') + "]"
                        vm.hasErrors = false;
                        vm.hasResult = true;
                    }
                    vm.isWithdrawButtonFreezed = false
                })
                .catch(function (result) {
                    vm.isWithdrawButtonFreezed = false
                });
        }
    },
});