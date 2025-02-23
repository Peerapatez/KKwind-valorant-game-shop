function toggleDropdown() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
  }
  
  
  function toggleAccountDropdown() {
    const accountDropdownMenu = document.getElementById('accountDropdownMenu');
    accountDropdownMenu.classList.toggle('hidden');
  }
  
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('hidden');
  }
  
  function toggleMobileDropdown() {
    const mobileDropdownMenu = document.getElementById('mobileDropdownMenu');
    mobileDropdownMenu.classList.toggle('hidden');
  }
  function toggleMenuDropdown() {
    const menuDropdown = document.getElementById('menuDropdown');
    menuDropdown.classList.toggle('hidden'); // สลับการแสดง dropdown เมื่อคลิก
}


const buy = () =>{
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
      });
    }
  });
}


