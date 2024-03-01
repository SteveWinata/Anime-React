import axios from "axios";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

const Create = () => {
    const [title, setTitle] = useState('');
    const [producer, setProducer] = useState('');
    const [slug, setSlug] = useState('');
    const [timeOutId, setTimeOutId] = useState(null);
    const [synopsis, setSynopsis] = useState('');
    const navigate = useNavigate();
    const handleSubmit = async (e) => {
        try{
            e.preventDefault();
            const data = {
                title,
                producer,
                slug,
                synopsis
            }
            const res = await axios.post('http://127.0.0.1:8000/api/animes', data);
            navigate('/');
        }catch(e){
            console.log(e);
        }
    }
    const handleSlug = (words) =>{
        if(timeOutId){
            clearTimeout(timeOutId);
        }
        const id = setTimeout(async () => {
            try{
                if(words.length === 0){
                    setSlug(words);
                    return;
                }
                words = words.replaceAll(' ', '-');
                const res = await axios.post('http://127.0.0.1:8000/api/anime/checkSlug', {slug:words});
                setSlug(res.data.slug)
                console.log(res.data.slug);
            }catch(err){
                    console.log(err);
            }
        },1000);

        setTimeOutId(id);
    }
    return ( 
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-6 my-2">
                    <h1 className="text-center border-bottom">Add Anime</h1>
                    <form onSubmit={(e) => handleSubmit(e)} className="">
                        <div className="mb-3">
                            <label htmlFor="title" className="form-label">Title</label>
                            <input type="text" className="form-control" required value={title} onChange={(e) => {setTitle(e.target.value); handleSlug(e.target.value)}} id="title" placeholder="Insert the title here" />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="producer" className="form-label">Producer</label>
                            <input type="text" className="form-control" value={producer} onChange={(e) => setProducer(e.target.value)} required id="producer" placeholder="Insert the producer here" />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="slug" className="form-label">Slug</label>
                            <input type="text" readOnly className="form-control" value={slug} required id="slug" />
                        </div>
                        <div className="mb-3">
                            <label htmlFor="synopsis" className="form-label">Synopsis</label>
                            <textarea className="form-control" value={synopsis} onChange={(e) => setSynopsis(e.target.value)} required id="synopsis"></textarea>
                        </div>
                        <button className="btn btn-primary">Submit data</button>
                    </form>
                </div>
            </div>
        </div>
    );
}
 
export default Create;