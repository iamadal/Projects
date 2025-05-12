/**
 * From The Typescript HandBook
 * Typescript is the superset of javascript.
 * 24 NOV 2024
 * Updated 23 April 2025
 * @author ADAL KHAN - mdadalkhan@gmail.com
 * */

// ##01
// Accessing the property 'toLowerCase'
// on 'message' and then calling it
message.toLowerCase();
// Calling 'message'
message();

// Type is not defined. so getting result from these code is totally unknown to us
/*
Is message callable?
Does it have a property called toLowerCase on it?
If it does, is toLowerCase even callable?
If both of these values are callable, what do they return?
 */
const message = "Hello World!"; // Let We have defined it 


const user = {
  name: "Daniel",
  age: 26,
};
user.location; // returns undefined



const user = {
  name: "Daniel",
  age: 26,
};
 
//user.location;
//Property 'location' does not exist on type '{ name: string; age: number; }'.


/*------------------------------------------------------------------------------*/
// Types
/* Primitives: string, number, boolean. do not use Captial letter like String they can refers to an object
   Arr[]  this is array type
   any - when type is nof defined
   unknown - safer version of any
   null
   undefined
*/

// type annonation- let, const, var 

async function getFavoriteNumber(): Promise<number> {
  return 26;
}


