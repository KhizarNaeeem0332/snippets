// written by khizar naeem
string name = "khizar";
// convert string to character array.
char[] inverse = name.ToCharArray();
//reverse string using Array class of .net
Array.Reverse(inverse);
//show string using new String();
console.writeLine(new String(inverse));
