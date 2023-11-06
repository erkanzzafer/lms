<div>
  <button type="button" wire:click.prevent="deneme">{{ $butonName }}</button>

  @if($butonName2)
  <script>
      // JavaScript kullanarak uyarıyı göster
      alert("{{ $butonName2 }}");
  </script>
@endif
</div>
@livewireScripts
