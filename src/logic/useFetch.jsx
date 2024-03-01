import axios from "axios";
import { useEffect, useState } from "react";

const useFetch = (url) => {
    const [data, setData] = useState(null);
    const [isPending, setIsPending] = useState(true);
    const [error, setError] = useState(null);

    const getData = async (link) =>{
        try{
            const res = await axios.get(link);
            setData(res.data);
            console.log(res.data);
            setIsPending(false);
        }catch(err){
            if(err.response.status === 404){
                setError('The requested resource could not be found')
            }
            // setError(err);
            // console.log(err);
        }finally{
            setIsPending(false);
        }
    }
    useEffect(()=>{
        getData(url)
    }, [url]);
    return { data, isPending, error};
}
 
export default useFetch;