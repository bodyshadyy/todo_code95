<div>     
    <form class="flex items-center" action"/dashboard" method="POST">
        @csrf
       
        <x-form-input name="name" id="name" placeholder="hello"/>
           
        <x-form-button>add</x-form-button>
        <x-form-error name="name"></x-form-error>
        

    </form>
</div> 