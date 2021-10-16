<script>
    function confirmdelete(e) {
        if (confirm("are you sure to delete?") == false) {
            e.preventDefault();
        }
    }

    function closeerror() {
        document.getElementsByClassName('error')[0].style.display = 'none'
    }
</script>
</body>

</html>