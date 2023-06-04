/**
 * Returns a random number with three character
 */
const randomNumber = () => {
    return `${parseInt(Date.now() * Math.random())}`.slice(0, 3);
}

