<?php

$config['admin_template']='adminlte3';
$config['session_name'] = 'zeusisys';
$config['asset_url']=asset('/');
$config['asset_path']=public_path('/');
$config['upload_url']=asset('/uploads/');
$config['upload_path']=public_path('/uploads/');
$config['thumbnail']=true;
$config['thumbnail_size']=[200,800];

$config['avatar']='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAMgAA/+4ADkFkb2JlAGTAAAAAAf/bAIQACAYGBgYGCAYGCAwIBwgMDgoICAoOEA0NDg0NEBEMDg0NDgwRDxITFBMSDxgYGhoYGCMiIiIjJycnJycnJycnJwEJCAgJCgkLCQkLDgsNCw4RDg4ODhETDQ0ODQ0TGBEPDw8PERgWFxQUFBcWGhoYGBoaISEgISEnJycnJycnJycn/8AAEQgCWAJYAwEiAAIRAQMRAf/EAHwAAQEAAwEBAQAAAAAAAAAAAAABBAUGAwIHAQEAAAAAAAAAAAAAAAAAAAAAEAEAAgIBAQMHCgQFBAMBAAAAARECAwQFITESQVFxkSJSE2GBobHB0TJCcgZiIzMU4YKSwjSy0nMk8UNjFhEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A3IAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUU9dXG5G/+jqz2fpxmYZ2roHUtnbOuNcT5c8o+rG5BrKKb7D9sbp/qcjHH9OM5fX4WRj+2NEfj5Gc+iIj7wczRTqo/bXB7L2bZ+fH/tfX/wDOdP8APs/1R9wOTop1U/trgTPZntj5Iyx/7Xxl+2ONP4d+cemIn7gcxRToM/2vnH9PkxPyZY19Uyxdv7d6jh+CMNn6cq/6vCDU0UyN3B5nH7d2jPCI/NMTXrjsY4FFABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUUAFAABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAUUAFFABRQAU+9WrZuzjXqxnPPLuxxi5B8PTTx9/Jz8GjXlsy82MXXp8zfcH9uR2bOdl8vwcJ/6svub7Vp1aMI16cIwwjyYxQOc4v7a3Z1ly9ka49zD2svX3fW3HH6P0/jVOOmM8o/Ns9qfp7PoZwCRERFRFRHdEKAAAAAAAAADF5HTeDyb+NoxnKfzRHhy9eNMoBz/J/bOM3lxNtT7mz/uj7mk5XB5fDmuRqnGPJl34z88dju0yxxzxnHKIyxnsmJ7YkH56Oq5v7e4+68+LPwdnu9+E/c5zlcPkcPP4fIwnGfJPkn0SDwCigAooAKKACigAooAKKACigAooAKKACigAooAKKACigAoBQAAAAAAAAAAAAAAAAAAAAAAAAbrpPRMuT4eTy4nHT34Yd05/dAMTp3SuRz8vFHsaY/Ftn6sfPLquHweNwcPBowqZ/FnPblPplkY444YxhhEY44xUYx2REKAAAAAAAAAAAAAAAAAAA892jTyNc6t2EZ4T3xL0Acr1LoW3jXu4t7NMds4/mx++GnfoTR9V6Hju8XI4cRjt789UdkZfLj5pBzIsxOMzjlFTHZMT3xKAAAAAAAAAAAAAAAAAAAAAAAAAC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC03HROlRyco5XIi9GM+zjP55j7IB69G6N8Tw8vl4+x36tU/m/iy+R0gAAAAAAAAAAAAAAAAAAAAAAAAA1HV+j48zGd/HiMeRHfHdGcfL8rlcsZxmccorKJqYnviYfoLSdb6TG/GeXx8f52Pbsxj80R5fTAOYFooEFooEFooEFooEFooEFooEFooEFooEFooEFooEFooEFoAAAAAAAAAAAAAAAAAAAAAABl9O4OXP5OOqOzCPa2ZebH75dphhhqwx164jHDGKxxjyRDC6TwY4XFiMords9rb6fJj8zPAAAAAAAAAAAAAAAAAAAAAAAAAAAAByvXOnf2u3+50xWnbPbEd2OX3S1DvOTx9fK0Z6NkeznFeifJPzOH36M+Puz0bIrLCan7/nB5gAAAAAAAAAAAAAAAAAAAAAoAAAAAAAAAAAAAAAAAAADZdE4n9zzIzyi9en28vT+WPW1rreh8b+34OOcx7e7259H5foBswAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHP8A7j4n9PmYR/Bs/wBs/Y6B48rRjyuNs0ZfnxmInzT5J+aQcKLljOGU45RWWM1MfLCAAAAAAAAAAAAAAAAAAAAACgIKAgoCCgIKAgoCCgIKAgoCCgPTj6Z5G/Xojv2ZRjfmue93WOMYYxhjFY4xERHyQ5b9v6fic/4kx2asZy+efZj63VAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA5Drej4HUNkxFY7YjZHz9/0w1zo/3JpvVp5EflynCf80XH1OdBBQEFAQUBBQEFAQUBBQEFAQUBBQAUBBQEFAQUBBQEFAQUBBQEFAQUB0X7a1Vq37veyjCP8sX/ALm8a3oWHg6drn35yy+nw/Y2QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMDrOr4vTt0eXGIzj5p7foce7rk4fE4+3X7+GWPrinDAgoCCgIKAgoCCgIKAgoCCgIKAgoAFFABRQAUUAFFABRQAUUAFFABRQAUUAFFA7TpmPg4HHj+CJ/1e19rKePFx8PF0Y91a8Yr0Yw9gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHCbcfBtzw93KY9Uu7cTzsfDzeRHdW3OvR4pBjhRQAUUAFFABRQAUUAFFABRQAUUAFFABQCi0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UDudMVq1xPfGMR9D7fOuYnXhMd04xP0PoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABxnUf8An8j/AMmX1uzcZ1GP/f5H/ky+sGKLRQILRQILRQILRQILRQILRQILRQILRQILRQILQAAAAAAAAAAAAAAAAAAAADuOPMTo1THdOGM/Q9HhwcvFw+Pl59eF/wCmHuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA4zqE3zuTP/wCmUeqadm4jlZeLk7svPsyn1zIPIAAAAAAAAAAAAAAAAAAAFFooEFooEFooEFooEFooEFooEFooEFooEFooEFooHX9M7eBx/wBEMthdIm+naJ+SY9WUwzQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHC5zeeU99zLucp8MTPmi3DUCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0UCC0AAAAAAAAAAAAAAAAAAAAA6noeXi6fhHu5ZR9N/a2LT/ALezvjbdfu5364j7m4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB5cnLwcbdn7uGU+qJcU67qmfg6fvnz4+H/AFTGP2uRAAAAAAAAAAAAAAAAAAAABQAAAAAAAAAAAAAAAAAAAbn9vbK3btXvYxl/pmv9zoHKdI2fC5+q+7O8J+eOz6XVgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA1fXtnh4UYeXPOI+aLlzTdfuHZezTpj8sTlPzzUfU0oAAAAAAAAAAAAAAAAAAAAKAAAAAAAAAAAAAAAAAAAD615zr2YbMe/CYyj0xNu1wyjPHHPHtxyiJifklxDqej7vjcHXE/i13rn5u76AZ4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPPftjTp2bp7sMZy9UA5jqu343O2zHdjPgj/L2T9LCXLKcspyy7ZmbmfllAAAAAAAAAAAAAAAAAAAAAUWigQWigQWigQWigQWigQWigQWigQWigQWigQWigRt+g7/AAbs+PM9myPFj6cf8Gpp6cfblx9+vdj34TE1548sA7ITDLHPHHPGbxyiJifklQAAAAAAAAAAAAAAAAAAAAAAAAAAAAGr67v+HxcdMT27cu39OPbP002jl+r8j+45mURPsavYx+bv+kGALRQILRQILRQILRQILRQILRQILRQILRQILRQILRQILQAAAAAAAAAAAAAAAAAAAAAADo+icn4vGnTlPtaZqP0z3Nm5Pp/J/tOVhsn8E+zn+mfudZ3gAAAAAAAAAAAAAAAAAAAAAAAAAAAAx+dyI4vG2bfzRFYfqnucjMzM3PbMtt1zlfE3Y8bGfZ1duX6p+6GpAAAAAAAAAAAAAAAAAAAAAABRaKBBaKBBaKBBaKBBaKBBaKBBaKBBaKBBaKBBaKBBaKBHSdH5fx+P8LKf5mns9OPklzlPfh8nLicjHdHbEdmcefGe8HWj5wzx2YY54TeOUXE/JL6AAAAAAAAAAAAAAAAAAAAAAAAAeHM5OPE4+e6e+OzCPPlPc93N9X5f9xv+FhP8rV2R8uXlkGvyyyzynLKbyym5nzzKLRQILRQILRQILRQILRQILRQILRQILRQILRQILRQILRQILQAAAAAAAAAAAAAAAAAAAAAAAADc9F5tf+nsnv7dUz9OLduMxnLHKMsZrKJuJjyTDqOn8yOZojKezZj2bMfl8/zgywAAAAAAAAAAAAAAAAAAAAAAee/dhx9WW7ZNY4x6/kgGH1Xm/wBtp+HhP83Z2Y/JHlyc29eRv2cndlu2d+XdHmjyQ8gAAAAAAAAAAAAAAAAAAAAAAAAUKKACigAooAKKACigAooAKKACigAooAKKACigAooB78Tk58TdG3D0ZY+ePM8KKB2Gndr368duubxyi4+59ua6bzp4mzw59unP8Ueafeh0mOWOWMZYzeM9sTHdMAoAAAAAAAAAAAAAAAAAAAEzERMzNRHbMy5rqfOnl7fBhP8AJw/D8s+8yurdQ8d8XRPs/wD25R5f4Y+1p6ACigAooAKKACigAooAKKACigAooAKKACigAooAKKACgFAAAAAAAAAAAAAAAAAAAAAAAAAAZ/T+pZ8Sfh7Ly0z5PLj8sMAB1+vbr3YRs15RljPdMPtqehf0dv6o+ptgAAAAAAAAAAAAAAAAJmIiZmaiO+Wk6h1XxXo4s+z3ZbI8vyYtl1D/AIW79LlgAAAAAAAAAAAAAAAAAAAAAAAAAAAAUWigQWigQWigQWigQWigQWigQWigQWigQWigQWigQWigQWigQWntp4nI5E/ytc5R73dHrkHgNxo6H3TyNn+XD75Z8dN4UYeD4MTHnm79feDE6H/S2/qj6m1YnC4n9nO7CJvDLKMsJ8tV3SywAAAAAAAAAAAAAAAAY3UP+Fu/S5d1fK1ZbuPs1Y9k5xUTLy19M4evXGE64zny5Zdsz9wOZG839E1ZXOjOcJ93Ltj72t39P5XH7c8JnH3se2AYotFAgtFAgtFAgtFAgtFAgtFAgtFAgtFAgtFAgtFAgtFAgtFAgtAAAAAAAAAAAAAAAAAAAAAALGOWU1jEzM90R2ggzNPS+Zt7fB4I8+fZ9Hez9XRNcdu7ZOU+bHsj7QePR+Np2xs27cYznGYjGJ7Yj5m7iIiKjsh5aOPp42M46cfDE9s9szfreoAAAAAAAAAAAAAAAAAAAAAAAANd1Ti6MuNnvjCMdmFT4o7L7a7Wgdds14bcJ17I8WOXfEtft6Lxs+3Vllrnzfij6e36QaEbDd0fl6+3CtkfwzU+qWDnr2ap8OzCcJ82UUD5AAAAAAAAAAAAAAAAAAAAABQooAKKACigAooAKKACigAooAKKAHvo4fI5H9LCZj3p7I9ctlo6LhFTyM/FPu4dkesGniJymsYuZ7ohmael8vdUzj8PHz59k+rvb3Vx9GiK1YRj8sd/r73qDW6ejcfDt25Tsnzfhj6O36Wfr06tMVqwxwj5Ip9gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACZYY5x4c8Yyx80xcKAwd3SeJt7cInXl/D3eqWv3dH5Ou51TG2Pk7J9Ut8A5LPXs1ZeHZjOOXmmKfLrc9eGzHw7MYyx80xbA39H4+y50zOrLzd+INCMvf03laLmcfHj72Hb9HexKACigAooAKKACigAooAKKACigAoBQAAAAAAAAAAABl8Xp3I5NZV4Nc/ny+yPK3PG6fx+NUxHjz9/Ltn5vMDT8fpvJ5FZV8PCfzZfZDa8fpfG01OUfFz8+Xd80M0A7uyO4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABjb+DxuR254Vl7+PZLJAaLkdI367y0z8XHzd2TX5Y5YzOOUTEx3xPZLrXjv4ujkxW3CJnyZd0x84OXGx5XSd2q89E/Fw835o+9rpiYmp7JjvgAAAAAAAAAAAAFCigAooAKKACigApm8Lp+zlTGeXsave8s/pBjadG3kZ+DVj4p8vmj0y3XF6Xp0VntrZs+X8MeiGXp069GEa9WPhxj6fS9AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGNyuDo5UXlHhz8mcd/wA/nZIDm+Vwt3Fn248WHkzju+fzMZ1mWOOUTjlETE9kxPbDT83pU43t40Xj3zr8sfpBqwooAKKACigAooAKAUAAAAAAGd07hf3OfxNkfysJ7f4p8wPvp/T/AI1bt8fy/wAuPvf4N3EREVEVEd0Qd3ZHcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA13P6dG692iK2d+WPky/wAWk7uye91jV9U4UZRPJ1R7Uf1MY8se8DTgAAAAAAAtFABRQAUUAPrVqy27MdeH4spqHTadWGjXjqwj2cYr/Fquj6bzz3zHZj7OPpnvbgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA7+yQBzvP439tvnHH8GXtYejzfMxqb3qmn4nG8cR7WufF83laICigAooAKABaKACigAooemjX8Xdr1+9lET6PKDe8DV8Hi68fLlHiy9M9rJAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEyxjPGcMu7KJifRLmNmudezLXl34zMT8zqGj6rr8HK8cd2yIn547AYNFABRQAUAALRQILRQIz+k6/FyZz8mGMz889jBpt+j4Vq2bPeyiPVH+INkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA1vWNd6cNnlxyqfRP/w2TH52HxOJtjzR4v8AT2g50WigQWigQWgAUBBQEb/p2Hg4mvzzeXrloXSaMfBp14e7jEfQD0AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAATLGMsZxnumJifnUBy8xMTMT3x2Sj35WPg5O3H+KZ9c28QQUBBQAAAAH1hj4s8cfemI9bpnO8WPFydUfxxPql0QAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANF1LGuXnPniJ+hiM/q0VyMZ8+EfXLAAAAAAFAQUBkcCL5mqPlmfVEy37R9Ni+Xj8kTP0N4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADVdXj29U+eJj1U1ja9Xjs0z+r7GrBBQEFABaKBBaKBmdLi+V6MZbppul/wDJn9M/Y3IAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANd1f+nr/VP1NS2/Vo/k4fq+xqaBBaKBBaAAAAAZvS/wDkz+mfsblpul/8mf0z9jcgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAwOrf0cP1fZLUNt1af5WuP4vsakAAAAAAAAGX02a5eMeeJj6Lbtz3Gz+Hv15+SMov0eV0IAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANb1eezVj+qfqatndUz8XIjD3MY9c9rBAAAABQAAAHRac/iacM/exiZ9NAD7AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABz/Jz+JyNmfnymvRHZDyAAAAAH//Z';

$config['logo']='data:image/jpeg;base64,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';

return $config;