#!/usr/bin/env ruby

require 'nokogiri'
require 'open-uri'

doc = Nokogiri::HTML(open('http://barcamproc.org/sponsor/'))

targets = ['money', 'fall']
found_nodes = []
found_blurbs = []

doc.xpath('//*').each do |node|
  next if node.path == '/html' || node.path == '/html/body'
  targets.each do |target|
    if node.content =~ /#{target}/i
      found_nodes << node
    end
  end
end

found_nodes.uniq.each do |node|
  found_blurbs << node.content.strip.gsub(/[\r\n\t\s]+/, ' ') if node.content
end

puts found_blurbs
