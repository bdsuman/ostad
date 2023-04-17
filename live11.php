<script>
function gradeCalculator(mark) {
  if (isNaN(mark) || mark < 0 || mark > 100) {
    return "Error: Invalid Mark Input";
  } else if (mark >= 90 && mark <= 100) {
    return "A";
  } else if (mark >= 80 && mark <= 89) {
    return "B";
  } else if (mark >= 70 && mark <= 79) {
    return "C";
  } else if (mark >= 60 && mark <= 69) {
    return "D";
  } else {
    return "F";
  }
}
console.log(gradeCalculator(85)); 
console.log(gradeCalculator("abc"));
</script>