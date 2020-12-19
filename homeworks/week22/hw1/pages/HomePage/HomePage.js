import React, { useState, useEffect } from "react";
import PropTypes from "prop-types";
import { getPosts } from "../../WebAPI";
import styled from "styled-components";
import { Link } from "react-router-dom";

const Root = styled.div`
  text-align: center;
  margin-top: 80px;
  text-decoration: none;
`;
const Loading = styled.div`
  z-index: 999;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  font-size: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
`;
const PostContainer = styled.div`
  border-bottom: 1px solid rgba(0, 12, 34, 0.2);
  padding: 16px;
  display: flex;
  justify-content: space-between;
  width: 700px;
  margin: 0px auto;
  :hover {
    background: rgba(0, 12, 34, 0.2);
  }
`;

const PostTitle = styled(Link)`
  font-size: 24px;
  width: 400px;
  text-align: left;
  text-decoration: none;
  color: black;
  :hover {
    color: blue;
  }
`;

const PostDate = styled.div`
  color: rgba(0, 0, 0, 0.8);
`;
const PageSign = styled.div`
  margin: 20px 20px;
  display: inline-block;
`;

function Post({ post }) {
  return (
    <PostContainer>
      <PostTitle to={`/post/${post.id}`}>{post.title}</PostTitle>
      <PostDate>{new Date(post.createdAt).toLocaleString()}</PostDate>
    </PostContainer>
  );
}

Post.propTypes = {
  post: PropTypes.object,
};

export default function HomePage() {
  const [posts, setPosts] = useState([]);
  const [totalPage, setTotalPage] = useState();
  const [page, setPage] = useState(1);
  const [isLoading, setIsLoading] = useState(false);
  const itemPerPage = 5;

  useEffect(() => {
    getPosts(page, itemPerPage).then((post) =>
      setTotalPage(Math.ceil(post.headers.get("X-Total-Count") / itemPerPage))
    );

    setIsLoading(true);
    getPosts(page, itemPerPage)
      .then((res) => res.json())
      .then((posts) => {
        setIsLoading(false);
        setPosts(posts);
      });
  },[page]);

  const handleFirstPage = () => {
    pageChanged(1, itemPerPage);
  };

  const handleLastPage = () => {
    pageChanged(totalPage, itemPerPage);
  };
  const handlePreviousPage = () => {
    if (page !== 1) {
      pageChanged(page - 1, itemPerPage);
    }
  };

  const handleNextPage = () => {
    if (page !== totalPage) {
      pageChanged(page + 1, itemPerPage);
    }
  };

  function pageChanged(newSet, itemPerPage) {
    if (isLoading) {
      return;
    }
    setPage(newSet);
    setIsLoading(true);
    getPosts(newSet, itemPerPage)
      .then((res) => res.json())
      .then((posts) => {
        setIsLoading(false);
        setPosts(posts);
      });
  }

  return (
    <Root>
      {isLoading && <Loading>Loading....</Loading>}
      {posts.map((post) => (
        <Post key={post.id} post={post} />
      ))}
      <button onClick={handleFirstPage}>第一頁</button>
      <button onClick={handlePreviousPage}>上一頁</button>
      <PageSign>
        {page}/{totalPage}
      </PageSign>
      <button onClick={handleNextPage}>下一頁</button>
      <button onClick={handleLastPage}>最後一頁</button>
    </Root>
  );
}
